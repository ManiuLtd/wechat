<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Api\BaseController;
use App\Repositories\CommonRepository;
use App\libs\DES;
use App\libs\Http;
use App\Merchant;
use App\smscode;

class CommonController extends BaseController
{   


    protected $repo;

    public function __construct(CommonRepository $repo)
    {
        $this->Repo = $repo;
    }

    /**
     * @SWG\Get(path="/getSmsCode",
     *   tags={"通用接口"},
     *   summary="根据手机号获取验证码",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="phone",
     *     in="query",
     *     description="手机号",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
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
     *     ),
     *   )
     * )
     */
    public function getSmsCode(Request $request)
    {	
    	$mobile = $request->phone;

        $outputArr = getSMSCode($mobile);

        if($outputArr['output']['code'] == '0'){
           
            $smsColl = smscode::where(['mobile'=>$mobile])->first();

            if($smsColl){
                $smsColl->code = $outputArr['code'];
                $smsColl->save();
            }else{
                smscode::create([
                    'code'=>$outputArr['code'],
                    'mobile'=>$mobile
                ]);
            }
            return response()->json(['message' => '发送成功','status'=> 0]);
        }else{
            return response()->json(['message' => '发送失败','status'=> 1]);
        }
    }

    /**
     * @SWG\Get(path="/getAgents",
     *   tags={"通用接口"},
     *   summary="地区接口",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
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
     *     ),
     *   )
     * )
     */
    public function getAgents(Request $request)
    {   
        $merchants = Merchant::all();

        $agents = $merchants->map(function($i,$v){
            return [
                 'id'=>$i->id,
                 'merchant_name' => $i->name,
                 'agents' => $i->agents
            ];
        });
        
        return $this->response->array($agents->toArray());
    }


    /**
     * @SWG\Get(path="/lxStock",
     *   tags={"通用接口"},
     *   summary="量炫库存查看接口",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
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
     *     ),
     *   )
     * )
     */
    public function lxStock(Request $request)
    {   
       $resp = $this->Repo->lxStock($request);
       return $this->response->array($resp);
    }

    /**
     * @SWG\Post(path="/lxBuy",
     *   tags={"通用接口"},
     *   summary="lx购买流量接口",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="reqId",
     *     in="formData",
     *     description="分销商请求ID  长度小于30渠道号+时间(年月日时分秒)+6位随机数",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="accNbr",
     *     in="formData",
     *     description="手机号码",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="offerSpecl",
     *     in="formData",
     *     description="销售品销售ID",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="goodName",
     *     in="formData",
     *     description="销售品名称",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
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
    public function lxBuy(Request $request)
    {   
     
       $resp = $this->Repo->lxBuy($request);
       return $this->response->array($resp);
    }


    /**
     * @SWG\Get(path="/queryOrder",
     *   tags={"通用接口"},
     *   summary="lx订购查询接口",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="reqId",
     *     in="query",
     *     description="分销商请求ID",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
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


    /**
     * @SWG\Get(path="/checkAccount",
     *   tags={"通用接口"},
     *   summary="lx分销对账接口",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="date",
     *     in="query",
     *     description="日期：’yyyymmdd’,’yyyymm’",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="dateType",
     *     in="query",
     *     description="日期类型：’0’按天；’1’：按月",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
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
    public function checkAccount(Request $request)
    {
       $resp = $this->Repo->checkAccount($request);
       return $this->response->array($resp);
    }

    /**
     * @SWG\Get(path="/queryStock",
     *   tags={"通用接口"},
     *   summary="lx分销库存同步接口",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
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
    public function queryStock(Request $request)
    {
       $resp = $this->Repo->queryStock($request);
       return $this->response->array($resp);
    }


    /**
     * @SWG\Get(path="/singleStock",
     *   tags={"通用接口"},
     *   summary="lx通过商品销售id查看库存",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="saleId",
     *     in="query",
     *     description="商品销售id",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
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
    public function singleStock(Request $request)
    {
       $resp = $this->Repo->singleStock($request);
       return $this->response->array($resp->toArray());
    }

}
