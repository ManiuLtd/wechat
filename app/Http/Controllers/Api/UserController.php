<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use App\Http\Transformers\PersonordersTransformer;
use App\Http\Transformers\DetailsTransformer;
use App\Http\Transformers\UserTransformer;
use App\Http\Transformers\OrdersTransformer;
use App\Repositories\UsersRepository;

use \Firebase\JWT\JWT;
use App\Admin;
use App\User;
use App\Personorder;
use App\Good;
use App\Detail;
use App\Order;
use App\Agent;
use DB;


class UserController extends BaseController
{   

    protected $repo;

    public function __construct(UsersRepository $repo)
    {
        $this->Repo = $repo;
    }

    /**
     * @SWG\Get(path="/register",
     *   tags={"用户"},
     *   summary="用户注册",
     *   description="返回值说明: status为0则成功，1(手机号已被使用),2(公司名已注册),3(验证码不正确),4(验证码过期),5(重新获取验证码)，6(微信号已注册过公司)",
     *   operationId="用户注册",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="name",
     *     in="query",
     *     description="公司",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="phone",
     *     in="query",
     *     description="手机号",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="openid",
     *     in="query",
     *     description="openid",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="code",
     *     in="query",
     *     description="验证码",
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
    public function register(Request $request)
    {
        $res = $this->Repo->newUser($request);
        return response()->json($res);
    }

      /**
     * @SWG\Get(path="/login",
     *   tags={"用户"},
     *   summary="用户登录",
     *   description="返回值说明: status为0则成功，1(账户不存在),3(验证码不正确),4(验证码过期),5(重新获取验证码)",
     *   operationId="用户注册",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="phone",
     *     in="query",
     *     description="手机号",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="code",
     *     in="query",
     *     description="验证码",
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
    public function login(Request $request)
    {
       // return ['status'=>'11','bb'=>'ccc'];
        $res = $this->Repo->loginUser($request);
        return response()->json($res);
    }

     /**
     * @SWG\Post(path="/buy",
     *   tags={"用户"},
     *   summary="用户购买流量接口",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="phone",
     *     in="formData",
     *     description="手机号",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="good_id",
     *     in="formData",
     *     description="商品id",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="openid",
     *     in="formData",
     *     description="openid",
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
    public function buy(Request $request)
    {   
        $order_num = orderNum();
        $openid = $request->openid;

        //商品价格
        $price = Good::findOrFail($request->good_id)->money;

        //查找用户
        $user = User::where('openid',$openid)->first();

        //判断用户是否存在
        if(!$user){
            $user = User::create(['openid'=>$openid]);
        }

        $porder = $user->porders()->create([
            'order_num' => $order_num,
            'phone' => $request->phone,
            'good_id' => $request->good_id,
            'price' => $price,
            'status' => 0,
        ]);
        return $this->response()->array(compact('porder'));
    }

    /**
     * @SWG\Get(path="/personorders",
     *   tags={"用户"},
     *   summary="根据openid获取ToC订单",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="openid",
     *     in="query",
     *     description="openid",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="per_page",
     *     in="query",
     *     description="每页显示数量",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="page",
     *     in="query",
     *     description="当前是多少页",
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
    public function personorders(Request $request)
    {   
       //改为根据openid获取 
       $user = User::where('openid',$request->openid)->first();
        
       $porders = Personorder::where('user_id',$user->id)->orderBy('id','desc')->paginate($request->per_page);

       return $this->response->paginator($porders,new PersonordersTransformer);
    }

    /**
     * @SWG\Post(path="/batchBuy",
     *   tags={"用户"},
     *   summary="企业用户购买流量接口",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="token",
     *     in="formData",
     *     description="token",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="good_id",
     *     in="formData",
     *     description="商品id",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="stock",
     *     in="formData",
     *     description="数量",
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
    public function batchBuy(Request $request)
    {   

        $info = checkToken($request->token);

        //获取当前用户
        $user = User::findOrFail($info['uid']);

        //产品id
        $good = Good::findOrFail($request->good_id);

        //创建订单
        DB::transaction(function () use($user,$request,$good){
            $order = $user->orders()->create([
                'order_num' => orderNum(),
                'total' => $request->stock * $request->price,
            ]);

            $details = new Detail([
                'stock' => $request->stock,
                'price' => $good->money,
                'usedCnt' => 0,
                'unUsedCnt' => $request->stock,
                'good_id' => $request->good_id,
            ]);
            $order->details()->save($details);
        });

        return response()->json(['message' => '提交成功','status'=> 0]);
    }

    /**
     * @SWG\Get(path="/orders",
     *   tags={"用户"},
     *   summary="根据token获取企业ToB订单",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="token",
     *     in="query",
     *     description="token",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="per_page",
     *     in="query",
     *     description="每页显示数量",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="page",
     *     in="query",
     *     description="当前是多少页",
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
    public function orders(Request $request)
    {
       $info = checkToken($request->token);
         return ['info'=>$info];

       $orders = Order::where('user_id',6)->paginate($request->per_page);;
       return $this->response->paginator($orders,new OrdersTransformer);
    }


    /**
     * @SWG\Get(path="/stocks",
     *   tags={"用户"},
     *   summary="根据token获取企业流量包库存",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="token",
     *     in="query",
     *     description="token",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="agent_id",
     *     in="query",
     *     description="agent_id",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="saleType",
     *     in="query",
     *     description="流量包类型(1为国内，0为省内)",
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
    public function stocks(Request $request)
    {   
               
        $user = User::findOrFail(6);
        $agent_id = $request->agent_id;
        $saleType = $request->saleType;

        $details = $user->details
        ->filter(function($i,$v) use($agent_id,$saleType){
            if($i->good->agent_id == $agent_id && $i->good->saleType == $saleType && $i->order->status == '支付成功'){
                return true;
            }
        })
        ->groupBy(function ($item, $key) {
            return Good::findOrFail($item['good_id'])->product->name;
        })->map(function($i,$v){
            return $i->sum('unUsedCnt');
        });

        $data = [
            'name' => $user->name,
            'desc' => '企业流量用户库存',
            'type' =>  $request->saleType ? '国内流量包' : '省内流量包',
            'agent' => Agent::findOrFail($agent_id)->name,
            'stocks' => $details
        ];

        return $this->response()->array($data);
    }

}
