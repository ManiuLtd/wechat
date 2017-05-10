<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\ForeignRepository;
use App\User;
use App\Good;
use App\Order;
use App\libs\RedisLock;
use App\Detail;

use Log;
use Exception;

class ForeignController extends BaseController
{

    protected $repo;

    public function __construct(ForeignRepository $repo)
    {
        $this->Repo = $repo;
    }

    /**
     * @SWG\Post(path="/orderBuy",
     *   tags={"对外接口"},
     *   summary="业务办理接口",
     *   description="",
     *   operationId="",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="phone",
     *     in="formData",
     *     description="手机号",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="saleId",
     *     in="formData",
     *     description="销售品销售id",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="goodId",
     *     in="formData",
     *     description="商品id",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="ztInterSource",
     *     in="formData",
     *     description="渠道号",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="staffValue",
     *     in="formData",
     *     description="协销工号id 在量炫流量平台注册的手机号",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="1",
     *     @SWG\Schema(type="json"),
     *     @SWG\Header(
     *       header="X-Rate-Limit",
     *       type="integer",
     *       format="int32",
     *       description="calls per hour allowed by the user"
     *     ),
     *     @SWG\Header(
     *       header="X-Expires-After",
     *       type="string",
     *       format="date-time",
     *       description="date in UTC when token expires"
     *     )
     *   )
     * )
     */
    public function orderBuy(Request $request)
    {   
        //公共参数
        $rn = randNum();
        $reqId = '200456'.date('YmdHis').$rn;
        $saleId = $request->saleId;
        $phone = $request->phone;
        $good_id = $request->goodId;
        $goodName = Good::findOrFail($good_id)->productName;
        
        //判断参数是否正确 10001参数错误  10002库存不够
        $creps = $this->checkParam($request,$reqId);    
        if($creps['status'] != 0){
            return $this->response->array($creps);
        }

        //根据手机号获取用户对象
        $user = User::where('phone',$request->staffValue)->first();
     
        //支付加锁过程 10003 redis锁错误
        $presp = $this->pay($user->id,$good_id);

        //判断redis加锁状态 和 是否库存足够
        if(!$presp['status']){
            $detailId = $presp['detailId'];
        }else{
            return $this->response->array(['status'=>$presp['status'],'msg'=>$presp['msg'],'reqId'=>$reqId]);
        }

        //请求接口开始交易
        $bresp = $this->Repo->lxBuy($reqId,$phone,$saleId,$goodName);
        //$code = $bresp['TSR_RESULT'];
        //$msg = $bresp['TSR_MSG'];

        //最远的一条订单详情
        $detail = Detail::findOrFail($detailId);

        if($bresp['TSR_RESULT'] == '0' || $bresp['TSR_RESULT'] == 0 || !$bresp['TSR_RESULT']){ //交易成功
            $detail->useds()->create([
                 'user_id' => $user->id,
                 'reqId' => $reqId,
                 'order_id' => $detail->order_id,
                 'phone' => $phone,
                 'saleId' => $saleId,
                 'goodId' => $good_id,
                 'status' => 1
            ]);

            return $this->response->array(['status'=>'0','msg'=>'交易成功','reqId'=>$reqId]);
        }else{ 
            $this->errBack($detailId,$user->id,$reqId,$saleId,$phone,$good_id); 
            //交易失败
            return $this->response->array(['status'=>'10005','msg'=>'交易失败','reqId'=>$reqId]);

        }
    }


    /**
     * @SWG\Get(path="/qOrder",
     *   tags={"对外接口"},
     *   summary="订购查询接口",
     *   description="",
     *   operationId="",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="reqId",
     *     in="query",
     *     description="分销商请求id",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="1",
     *     @SWG\Schema(type="json"),
     *     @SWG\Header(
     *       header="X-Rate-Limit",
     *       type="integer",
     *       format="int32",
     *       description="calls per hour allowed by the user"
     *     ),
     *     @SWG\Header(
     *       header="X-Expires-After",
     *       type="string",
     *       format="date-time",
     *       description="date in UTC when token expires"
     *     )
     *   )
     * )
     */
    public function queryOrder(Request $request)
    {   
       $resp = $this->Repo->queryOrder($request);
       return $this->response->array($resp);
    }

    //支付
    public function pay($userId,$good_id)
    {
        try {

            $redis = new RedisLock();
            $lockKey = 'pay' . $userId;
            $redis->getLock($lockKey,8);  //获取不到则抛出异常

             //判断是否有库存
            $user = User::findOrFail($userId);
            $stock = $user->details()->where('good_id',$good_id)->sum('unUsedCnt');
            if($stock <= 0){
                Log::info('10002: 库存不够');
                $redis->releaseLock($lockKey);
                return ['status'=>10002,'msg'=>'库存不够'];
            }
 

            //获取日期最远的订单
            $detail = $user->details()->orderBy('id','asc')->where('unUsedCnt','>','0')->where('good_id',$good_id)->first();
            
            //先执行扣库存
            $detail->unUsedCnt = $detail->unUsedCnt-1;
            $detail->usedCnt = $detail->usedCnt+1;
            $detail->save();

            //释放锁
            $redis->releaseLock($lockKey);
        } catch (Exception $e) {
             redisWengAway();
             Log::info('000000: redis报错');
            $redis->releaseLock($lockKey);
        }

        return ['status'=>0,'detailId'=>$detail->id];

    }

    //判断参数是否正确 并且判断库存是否足够
    public function checkParam($request,$reqId)
    {
        
        $phone = $request->phone; //手机号
        $saleId = $request->saleId; //商品销售id
        $good_id = $request->goodId; //商品id
        $ztInterSource = $request->ztInterSource;  //企业渠道号
        $staffValue = $request->staffValue; //注册企业手机号

        //判断用户存在否  企业渠道号
        $user = User::where('phone',$staffValue)->first();
     
        if(!$user || $user->ztInterSource != $ztInterSource){
            Log::info('10001: 请求参数错误');
            return ['status'=>'10001','msg'=>'请求参数错误，请检查后输入(staffValue,ztInterSource)','reqId'=>$reqId];
        }

        //判断商品名正确否  销售id正确否
        $good= Good::where('id',$good_id)->first();

        if(!$good || $good->saleId != $saleId){
            Log::info('10001: 请求参数错误');
            return ['status'=>'10002','msg'=>'请求参数错误，请检查后输入(goodName ,saleId)','reqId'=>$reqId];
        }

        if(strlen($phone) != '11'){
            Log::info('10001: 请求参数错误');
            return ['status'=>'10002','msg'=>'请求参数错误，请检查后输入(phone)','reqId'=>$reqId];
        }
      
        return ['status'=>0,'msg'=>'0k'];
    }

    //将记录添加到交易记录中  库存+1
    public function errBack($detailId,$user_id,$reqId,$saleId,$phone,$good_id)
    {
        $detail = Detail::findOrFail($detailId);
        $detail->useds()->create([
             'user_id' => $user_id,
             'reqId' => $reqId,
             'order_id' => $detail->order_id,
             'phone' => $phone,
             'saleId' => $saleId,
             'goodId' => $good_id,
             'status' => 0
        ]);

        //库存改回来
        $detail->unUsedCnt = $detail->unUsedCnt+1;
        $detail->usedCnt = $detail->usedCnt-1;
        $detail->save();

        return true;
    }

}
