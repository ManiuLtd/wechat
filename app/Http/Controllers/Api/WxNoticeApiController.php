<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use EasyWeChat\Foundation\Application;

class WxNoticeApiController extends Controller
{
    protected $app = null;
    public function __construct()
    {
        $options = weOption();
        $this->app = new Application($options);
    }

    /**
     * @SWG\Get(path="/WxNoticeApi/getIndustry",
     *   tags={"微信模板消息"},
     *   summary="返回所有支持的行业列表",
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
    public function getIndustry(Request $request)
    {
        $notice = $this->app->notice;
        $industries = $notice->getIndustry();
        return ['status' => 0, 'industries' => $industries];
    }

    /**
     * @SWG\Get(path="/WxNoticeApi/setIndustry",
     *   tags={"微信模板消息"},
     *   summary="修改账号所属行业",
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
    public function setIndustry(Request $request)
    {
        $notice = $this->app->notice;
        $result = $notice->setIndustry(1, 2);
        return ['status' => 0, 'result' => $result];
    }

    /**
     * @SWG\Get(path="/WxNoticeApi/addTemplate",
     *   tags={"微信模板消息"},
     *   summary="修改账号所属行业",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *     name="shortId",
     *     in="query",
     *     description="shortId",
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
    public function addTemplate(Request $request)
    {
        $notice = $this->app->notice;
        $result = $notice->addTemplate($request->shortId);
        return ['status' => 0, 'result' => $result];
    }

    /**
     * @SWG\Get(path="/WxNoticeApi/send",
     *   tags={"微信模板消息"},
     *   summary="发送模板消息, 返回消息ID；",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *     name="shortId",
     *     in="query",
     *     description="shortId",
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
    public function send(Request $request)
    {
        $notice = $this->app->notice;

        $messageId = $notice->send([
            'touser' => 'user-openid',
            'template_id' => 'template-id',
            'url' => 'xxxxx',
            'data' => [
                //...
            ],
        ]);

        return ['status' => 0, 'messageId' => $messageId];
    }

    /**
     * @SWG\Get(path="/WxNoticeApi/getPrivateTemplates",
     *   tags={"微信模板消息"},
     *   summary="获取所有模板列表",
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
    public function getPrivateTemplates(Request $request)
    {
        $notice = $this->app->notice;

        $lists = $notice->getPrivateTemplates();

        return ['status' => 0, 'lists' => $lists];
    }

    /**
     * @SWG\Get(path="/WxNoticeApi/deletePrivateTemplate",
     *   tags={"微信模板消息"},
     *   summary="获取所有模板列表",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="templateId",
     *     in="query",
     *     description="templateId",
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
    public function deletePrivateTemplate(Request $request)
    {
        $notice = $this->app->notice;

        $result = $notice->deletePrivateTemplate($request->templateId);

        return ['status' => 0, 'result' => $result];
    }

}
