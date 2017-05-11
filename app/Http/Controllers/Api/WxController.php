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

    /**
     * @SWG\Get(path="/wxapi/cardColors",
     *   tags={"微信"},
     *   summary="获取卡券顡色",
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
    public function cardColors(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $colors = $card->getColors();

        return ['status' => 1, 'color' => $colors];
    }

    /**
     * @SWG\Get(path="/wxapi/addCard",
     *   tags={"微信"},
     *   summary="创建卡券",
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
    public function addCard(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $cardType = 'DISCOUNT';

        $baseInfo = [
            'logo_url' => 'http://mmbiz.qpic.cn/mmbiz/2aJY6aCPatSeibYAyy7yct9zJXL9WsNVL4JdkTbBr184gNWS6nibcA75Hia9CqxicsqjYiaw2xuxYZiaibkmORS2oovdg/0',
            'brand_name' => '量炫未来',
            'code_type' => 'CODE_TYPE_TEXT',
            'title' => '江苏电信流量7折券',
            'sub_title' => '仅限江苏电信',
            'color' => 'Color010',
            'service_phone' => '13636607175',
            'description' => "必须为江苏电信号码段",
            'date_info' => [
                'type' => 'DATE_TYPE_FIX_TERM',
                'fixed_term' => 15, //表示自领取后多少天内有效，不支持填写0
                'fixed_begin_term' => 0, //表示自领取后多少天开始生效，领取后当天生效填写0。
            ],
            'sku' => [
                'quantity' => '500', //自定义code时设置库存为0
            ],
            "center_title" => "立即使用",
            "center_url" => "www.qq.com",

        ];
        $especial = [
            "discount" => 30
        ];
        $result = $card->create($cardType, $baseInfo, $especial);

        return ['status' => $result];
    }

    /**
     * @SWG\Get(path="/wxapi/cardQrcode",
     *   tags={"微信"},
     *   summary="创建卡券二维码",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *     name="cardId",
     *     in="query",
     *     description="cardId",
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
    public function cardQrcode(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $cards = [
            'action_name' => 'QR_CARD',
            'expire_seconds' => 1800,
            'action_info' => [
                'card' => [
                    'card_id' => $request->cardId,
                    'is_unique_code' => false,
                    'outer_id' => 1,
                ],
            ],
        ];
        $result = $card->QRCode($cards);

        return ['status' => $result];

    }

    /**
     * @SWG\Get(path="/wxapi/cardWhitelist",
     *   tags={"微信"},
     *   summary="创建卡券测试白名单",
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
    public function cardWhitelist(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $usernames = ['o0a3GwxicRXcsX4EDVF25yG-3_sg'];
        $result = $card->setTestWhitelistByUsername($usernames);


        return ['status' => $result];

    }

    /**
     * @SWG\Get(path="/wxapi/cardInfo",
     *   tags={"微信"},
     *   summary="卡券详情",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="cardId",
     *     in="query",
     *     description="cardId",
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
    public function cardInfo(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $cardId = $request->cardId;
        $result = $card->getCard($cardId);

        return ['status' => $result];

    }

    /**
     * @SWG\Get(path="/wxapi/increaseStock",
     *   tags={"微信"},
     *   summary="卡券增加库存接口",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="cardId",
     *     in="query",
     *     description="cardId",
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
    public function increaseStock(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $cardId = $request->cardId;

        $result = $card->increaseStock($cardId, 100);

        return ['status' => $result];

    }

    /**
     * @SWG\Get(path="/wxapi/reduceStock",
     *   tags={"微信"},
     *   summary="卡券减少库存接口",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="cardId",
     *     in="query",
     *     description="cardId",
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
    public function reduceStock(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $cardId = $request->cardId;

        $result = $card->reduceStock($cardId, 100);

        return ['status' => $result];

    }

    /**
     * @SWG\Get(path="/wxapi/createLandingPage",
     *   tags={"微信"},
     *   summary="创建货架接口",
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
    public function createLandingPage(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $banner = 'http://mmbiz.qpic.cn/mmbiz/iaL1LJM1mF9aRKPZJkmG8xXhiaHqkKSVMMWeN3hLut7X7hicFN';
        $pageTitle = '惠城优惠大派送';
        $canShare = true;
        //SCENE_NEAR_BY          附近
        //SCENE_MENU             自定义菜单
        //SCENE_QRCODE             二维码
        //SCENE_ARTICLE             公众号文章
        //SCENE_H5                 h5页面
        //SCENE_IVR                 自动回复
        //SCENE_CARD_CUSTOM_CELL 卡券自定义cell
        $scene = 'SCENE_IVR';
        $cardList = [
            ['card_id' => 'pgNetv0XDrXXvEK09RehtKyAEn-0', 'thumb_url' => 'http://test.digilinx.cn/wxApi/Uploads/test.png'],
            ['card_id' => 'pgNetv6kWwWGwkDocjLn2L93K53c', 'thumb_url' => 'http://test.digilinx.cn/wxApi/Uploads/aa.jpg'],
        ];
        $result = $card->createLandingPage($banner, $pageTitle, $canShare, $scene, $cardList);

        return ['status' => $result];

    }


}
