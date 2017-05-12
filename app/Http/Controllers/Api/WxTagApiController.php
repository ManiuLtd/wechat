<?php

namespace App\Http\Controllers\Api;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WxTagApiController extends Controller
{
    protected $app = null;
    public function __construct()
    {
        $options = weOption();
        $this->app = new Application($options);
    }

    /**
     * @SWG\Get(path="/WxTagApi/lists",
     *   tags={"微信用户标签"},
     *   summary="获取所有标签",
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
    public function lists(Request $request)
    {
        $tag = $this->app->user_tag;
        $tags = $tag->lists();
        return ['status' => 0, 'tags' => $tags];
    }

    /**
     * @SWG\Get(path="/WxTagApi/create",
     *   tags={"微信用户标签"},
     *   summary="创建标签",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="name",
     *     in="query",
     *     description="name",
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
    public function create(Request $request)
    {
        $tag = $this->app->user_tag;
        $result = $tag->create($request->name);
        return ['status' => 0, 'result' => $result];
    }

    /**
     * @SWG\Get(path="/WxTagApi/update",
     *   tags={"微信用户标签"},
     *   summary="修改标签信息",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="tagId",
     *     in="query",
     *     description="tagId",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="name",
     *     in="query",
     *     description="name",
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
    public function update(Request $request)
    {
        $tag = $this->app->user_tag;
        $result = $tag->update($request->tagId,$request->name);

        return ['status' => 0, 'result' => $result];
    }


    /**
     * @SWG\Get(path="/WxTagApi/delete",
     *   tags={"微信用户标签"},
     *   summary="删除标签信息",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="tagId",
     *     in="query",
     *     description="tagId",
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
    public function delete(Request $request)
    {
        $tag = $this->app->user_tag;
        $result = $tag->delete($request->tagId);

        return ['status' => 0, 'result' => $result];
    }


    /**
     * @SWG\Get(path="/WxTagApi/userTags",
     *   tags={"微信用户标签"},
     *   summary="获取指定 openid 用户身上的标签",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
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
    public function userTags(Request $request)
    {
        $tag = $this->app->user_tag;
        $userTags = $tag->userTags($request->openid);

        return ['status' => 0, 'userTags' => $userTags];
    }

    /**
     * @SWG\Get(path="/WxTagApi/usersOfTag",
     *   tags={"微信用户标签"},
     *   summary="获取标签下粉丝列表",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="tagId",
     *     in="query",
     *     description="tagId",
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
    public function usersOfTag(Request $request)
    {
        $tag = $this->app->user_tag;
        $users = $tag->usersOfTag($request->tagId, $nextOpenId = '');

        return ['status' => 0, 'users' => $users];
    }


    /**
     * @SWG\Get(path="/WxTagApi/batchTagUsers",
     *   tags={"微信用户标签"},
     *   summary="批量为用户打标签",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="openids",
     *     in="query",
     *     description="openids",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="tagId",
     *     in="query",
     *     description="tagId",
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
    public function batchTagUsers(Request $request)
    {
        $tag = $this->app->user_tag;
        $openIds = explode(',',$request->openids);
        $result = $tag->batchTagUsers($openIds, $request->tagId);


        return ['status' => 0, 'result' => $result];
    }

    /**
     * @SWG\Get(path="/WxTagApi/batchUntagUsers",
     *   tags={"微信用户标签"},
     *   summary="批量为用户取消标签",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="openids",
     *     in="query",
     *     description="openids",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="tagId",
     *     in="query",
     *     description="tagId",
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
    public function batchUntagUsers(Request $request)
    {
        $tag = $this->app->user_tag;
        $openIds = explode(',',$request->openids);
        $result = $tag->batchUntagUsers($openIds, $request->tagId);


        return ['status' => 0, 'result' => $result];
    }

}
