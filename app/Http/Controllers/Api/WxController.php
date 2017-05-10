<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use App\User;
use App\libs\wechatCallbackapiTest;
use App\libs\class_weixin_adv;


class WxController extends Controller
{


	/**
     * @SWG\Get(path="/wxapi/index",
     *   tags={"微信"},
     *   summary="服务端验证",
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
	public function index()
	{
		
          define("TOKEN", "xiaomo");

          $wechatObj = new wechatCallbackapiTest();
          if (!isset($_GET['echostr'])) {
              $wechatObj->responseMsg();
          }else{
              $wechatObj->valid();
          }
          
	}

	/**
     * @SWG\Get(path="/wxapi/auth",
     *   tags={"微信"},
     *   summary="获取openid",
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
	public function auth(Request $Request)
	{
		
	}

     /**
     * @SWG\Get(path="/wxapi/menu",
     *   tags={"微信"},
     *   summary="添加菜单",
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
     public function menu(Request $Request)
     {
          $wx = new class_weixin_adv();

          $data = '{
               "button":[
               {    
                    "type":"view",
                    "name":"首页",
                    "url":"http://xier.ana51.com/shouji/shouye/index.html"
                }]
          }';

          $res = $wx->create_menu($data);

         dump($res);
     }



}
