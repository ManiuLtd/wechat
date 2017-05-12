<?php

namespace App\Http\Controllers\Api;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WxQrcodeApiController extends Controller
{
    protected $app = null;
    public function __construct()
    {
        $options = weOption();
        $this->app = new Application($options);
    }

    /**
     * @SWG\Get(path="/WxQrcodeApi/temporary",
     *   tags={"微信二维码"},
     *   summary="创建临时二维码",
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
    public function temporary(Request $request)
    {
        $qrcode = $this->app->qrcode;
        $result = $qrcode->temporary(56, 6 * 24 * 3600);
        $ticket = $result->ticket;// 或者 $result['ticket']
        $expireSeconds = $result->expire_seconds; // 有效秒数
        $url = $result->url; // 二维码图片解析后的地址，开发者可根据该地址自行生成需要的二维码图片

        return ['status'=>0,'ticket'=>$ticket,'expireSeconds'=>$expireSeconds,'url'=>$url];

    }

    /**
     * @SWG\Get(path="/WxQrcodeApi/forever",
     *   tags={"微信二维码"},
     *   summary="创建永久二维码",
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
    public function forever(Request $request)
    {
        $qrcode = $this->app->qrcode;
        $result = $qrcode->forever(56);// 或者 $qrcode->forever("foo");
        $ticket = $result->ticket; // 或者 $result['ticket']
        $url = $result->url;

        return ['status'=>0,'ticket'=>$ticket,'url'=>$url];

    }

    /**
     * @SWG\Get(path="/WxQrcodeApi/url",
     *   tags={"微信二维码"},
     *   summary="获取二维码网址",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="ticket",
     *     in="query",
     *     description="ticket",
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
    public function url(Request $request)
    {
        $qrcode = $this->app->qrcode;
        $url = $qrcode->url($request->ticket);

        return ['status'=>0,'url'=>$url];

    }

    /**
     * @SWG\Get(path="/WxQrcodeApi/content",
     *   tags={"微信二维码"},
     *   summary="获取二维码内容",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="ticket",
     *     in="query",
     *     description="ticket",
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
    public function content(Request $request)
    {
        $qrcode = $this->app->qrcode;
        $url = $qrcode->url($request->ticket);

        $content = file_get_contents($url); // 得到二进制图片内容
        file_put_contents(__DIR__ . '/code.jpg', $content); // 写入文件

        return ['status'=>0,'debug'=>'debug'];

    }

}
