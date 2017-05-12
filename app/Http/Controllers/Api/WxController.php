<?php

namespace App\Http\Controllers\Api;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;

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
            'code_type' => 'CODE_TYPE_NONE',
            'title' => '江苏电信流量7折券',
            'sub_title' => '仅限江苏电信',
            'color' => 'Color100',
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
            "center_url" => "http://lx.ana51.com/toC/index.html",


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

        // by openid
        $openids = ['o0a3GwxicRXcsX4EDVF25yG-3_sg'];
        $result = $card->setTestWhitelist($openids);

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
     * @SWG\Get(path="/wxapi/cardList",
     *   tags={"微信"},
     *   summary="批量查询卡列表",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="offset",
     *     in="query",
     *     description="offset",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="count",
     *     in="query",
     *     description="count",
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
    public function cardList(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $offset      = $request->offset;
        $count       = $request->count;
        //CARD_STATUS_NOT_VERIFY,待审核；
        //CARD_STATUS_VERIFY_FAIL,审核失败；
        //CARD_STATUS_VERIFY_OK，通过审核；
        //CARD_STATUS_USER_DELETE，卡券被商户删除；
        //CARD_STATUS_DISPATCH，在公众平台投放过的卡券；
        $statusList = 'CARD_STATUS_NOT_VERIFY';
        $result = $card->lists($offset, $count, $statusList);


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

    /**
     * @SWG\Get(path="/wxapi/consume",
     *   tags={"微信"},
     *   summary="核销Code接口",
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
     *  @SWG\Parameter(
     *     name="code",
     *     in="query",
     *     description="code",
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
    public function consume(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $result = $card->consume($request->code, $request->cardId);

        return ['status' => $result];

    }




    /**
     * @SWG\Get(path="/wxapi/getUserCards",
     *   tags={"微信"},
     *   summary="获取用户已领取卡券接口",
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
    public function getUserCards(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $openid  = $request->openid;
        $cardId = ''; //卡券ID。不填写时默认查询当前appid下的卡券。
        $result = $card->getUserCards($openid, $cardId);

        return ['status' => $result];

    }


    /**
 * @SWG\Get(path="/wxapi/decryptCode",
 *   tags={"微信"},
 *   summary="Code解码接口",
 *   description="",
 *   operationId="loginUser",
 *   produces={"application/xml", "application/json"},
 *  @SWG\Parameter(
 *     name="encryptedCode",
 *     in="query",
 *     description="encryptedCode",
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
    public function decryptCode(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $encryptedCode = $request->encryptedCode;
        $result = $card->decryptCode($encryptedCode);

        return ['status' => $result];

    }

    /**
     * @SWG\Get(path="/wxapi/cardDelete",
     *   tags={"微信"},
     *   summary="删除卡券",
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
    public function cardDelete(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $cardId = $request->cardId;

        $result = $card->delete($cardId);


        return ['status' => $result];

    }


    /**
     * @SWG\Get(path="/wxapi/cardDisable",
     *   tags={"微信"},
     *   summary="卡券失效",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="code",
     *     in="query",
     *     description="code",
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
    public function cardDisable(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $code = $request->code;
        $cardId = '';
        $result = $card->disable($code, $cardId);

        return ['status' => $result];

    }

    /**
     * @SWG\Get(path="/wxapi/getCategories",
     *   tags={"微信"},
     *   summary="卡券开放类目查询",
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
    public function getCategories(Request $request)
    {
        $options = weOption();
        $app = new Application($options);

        $card = $app->card;

        $result = $card->getCategories();

        return ['status' => $result];

    }

    /**
     * @SWG\Get(path="/wxapi/getHtml",
     *   tags={"微信"},
     *   summary="图文消息群发卡券",
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
    public function getHtml(Request $request)
    {
        $options = weOption();
        $app = new Application($options);
        $card = $app->card;
        $cardId = $request->cardId;
        $result = $card->getHtml($cardId);

        return ['status' => $result];

    }



}
