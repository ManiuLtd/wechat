<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
class WxUserApiController extends Controller
{

    protected $app = null;
    public function __construct()
    {
        $options = weOption();
        $this->app = new Application($options);
    }

    /**
     * @SWG\Get(path="/wxUserApi/getUser",
     *   tags={"微信用户相关"},
     *   summary="根据openid获取用户信息",
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
     * @SWG\Get(path="/wxUserApi/getUserList",
     *   tags={"微信用户相关"},
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
     * @SWG\Get(path="/wxUserApi/setRemark",
     *   tags={"微信用户相关"},
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
     * @SWG\Get(path="/wxUserApi/getUserGroupId",
     *   tags={"微信用户相关"},
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
     * @SWG\Get(path="/wxUserApi/blacklist",
     *   tags={"微信用户相关"},
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
     * @SWG\Get(path="/wxUserApi/lists",
     *   tags={"微信用户相关"},
     *   summary="获取所有分组",
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

        $group = $this->app->user_group;
        $groups = $group->lists();
        return ['states'=>0, 'group'=>$groups];
    }

    /**
     * @SWG\Get(path="/wxUserApi/create",
     *   tags={"微信用户相关"},
     *   summary="创建分组",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
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

        $group = $this->app->user_group;
        $result = $group->create($request->name);

        return ['states'=>0, 'result'=>$result];
    }

    /**
     * @SWG\Get(path="/wxUserApi/update",
     *   tags={"微信用户相关"},
     *   summary="修改分组信息",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="name",
     *     in="query",
     *     description="name",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="groupId",
     *     in="query",
     *     description="groupId",
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

        $group = $this->app->user_group;
        $result = $group->update($request->groupId, $request->name);
        return ['states'=>0, 'result'=>$result];
    }

    /**
     * @SWG\Get(path="/wxUserApi/delete",
     *   tags={"微信用户相关"},
     *   summary="删除分组",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="groupId",
     *     in="query",
     *     description="groupId",
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
        $group = $this->app->user_group;
        $result = $group->delete($request->groupId);
        return ['states'=>0, 'result'=>$result];
    }

    /**
     * @SWG\Get(path="/wxUserApi/moveUser",
     *   tags={"微信用户相关"},
     *   summary="删除分组",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="groupId",
     *     in="query",
     *     description="groupId",
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
    public function moveUser(Request $request)
    {
        $group = $this->app->user_group;

        $result = $group->moveUser($request->openid, $request->groupId);

        return ['states'=>0, 'result'=>$result];
    }

    /**
     * @SWG\Get(path="/wxUserApi/moveUsers",
     *   tags={"微信用户相关"},
     *   summary="批量移动用户到指定分组",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="groupId",
     *     in="query",
     *     description="groupId",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="openids",
     *     in="query",
     *     description="openids",
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
    public function moveUsers(Request $request)
    {
        $group = $this->app->user_group;
        $openIds = explode(',',$request->openids);

        $result = $group->moveUsers($openIds, $request->groupId);

        return ['states'=>0, 'result'=>$result];
    }
}
