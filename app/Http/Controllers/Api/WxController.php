<?php

namespace App\Http\Controllers\Api;

use EasyWeChat\Foundation\Application;
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
        } else {
            $wechatObj->valid();
        }

    }

    /**
     * @SWG\Get(path="/wxapi/getMenu",
     *   tags={"微信"},
     *   summary="获取菜单",
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
    public function getMenu(Request $Request)
    {
        $options = weOption();
        $app = new Application($options);
        $menu = $app->menu;
        $menus = $menu->all()->toArray();

        return ['status' => 0, 'menu' => $menus];
    }

    /**
     * @SWG\Get(path="/wxapi/setMenu",
     *   tags={"微信"},
     *   summary="设置菜单",
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
    public function setMenu(Request $Request)
    {
        $options = weOption();
        $app = new Application($options);
        $menu = $app->menu;

        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key" => "V1001_TODAY_MUSIC"
            ],
            [
                "name" => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url" => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url" => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $menu->add($buttons);
        return ['status' => 0, 'msg' => 'ok'];
    }

    /**
     * @SWG\Get(path="/wxapi/getUser",
     *   tags={"微信"},
     *   summary="根据opendi获取用户信息",
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
    public function getUser(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $userService = $app->user;
        $info = $userService->get($request->openid);
        return ['status' => 0, 'info' => $info];
    }

    /**
     * @SWG\Get(path="/wxapi/getUserList",
     *   tags={"微信"},
     *   summary="获取用户列表",
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
    public function getUserList(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $userService = $app->user;
        $users = $userService->lists();
        return ['status' => 1, 'list' => $users];
    }

    /**
     * @SWG\Get(path="/wxapi/setRemark",
     *   tags={"微信"},
     *   summary="修改用户备注",
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
     *     name="remark",
     *     in="query",
     *     description="备注",
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
    public function setRemark(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $userService = $app->user;
        $userService->remark($request->openid, $request->remark);
        return ['status' => 0, 'msg' => 'ok'];
    }

    /**
     * @SWG\Get(path="/wxapi/getUserGroupId",
     *   tags={"微信"},
     *   summary="根据openid获取用户分组id",
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
    public function getUserGroupId(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $userService = $app->user;
        $id = $userService->group($request->openid);

        return ['status' => 1, 'gorupId' => $id];
    }

    /**
     * @SWG\Get(path="/wxapi/blacklist",
     *   tags={"微信"},
     *   summary="获取黑名单",
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
    public function blacklist(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $userService = $app->user;
        $lists = $userService->blacklist($beginOpenId = null);

        //拉黑    $userService->batchBlock(['openid1', 'openid2', 'openid3', '...']);
        //取消拉黑 $userService->batchUnblock(['openid1', 'openid2', 'openid3', '...']);

        return ['status' => 1, 'lists' => $lists];
    }

}
