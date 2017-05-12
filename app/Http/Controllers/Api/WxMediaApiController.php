<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Article;


class WxMediaApiController extends Controller
{
    protected $app = null;
    public function __construct()
    {
        $options = weOption();
        $this->app = new Application($options);
    }

    /**
     * @SWG\Get(path="/WxMediaApi/uploadImage",
     *   tags={"微信素材"},
     *   summary="上传图片",
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
    public function uploadImage(Request $request)
    {
        $material = $this->app->material;
        $path = storage_path('hs.jpg');
        $result = $material->uploadImage($path);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）
        return ['status' => 0, 'result' => $result];
    }


    /**
     * @SWG\Get(path="/WxMediaApi/uploadVoice",
     *   tags={"微信素材"},
     *   summary="上传音频",
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
    public function uploadVoice(Request $request)
    {
        $material = $this->app->material;
        $path = storage_path('6839.wav');
        $result = $material->uploadVoice($path);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）
        return ['status' => 0, 'result' => $result];
    }


    /**
     * @SWG\Get(path="/WxMediaApi/uploadVideo",
     *   tags={"微信素材"},
     *   summary="上传视频",
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
    public function uploadVideo(Request $request)
    {
        $material = $this->app->material;
        $path = storage_path('mp4.mp4');
        $result = $material->uploadVoice($path);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）
        return ['status' => 0, 'result' => $result];
    }

    /**
     * @SWG\Get(path="/WxMediaApi/uploadThumb",
     *   tags={"微信素材"},
     *   summary="上传缩略图",
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
    public function uploadThumb(Request $request)
    {
        $material = $this->app->material;
        $path = storage_path('hs.jpg');
        $result = $material->uploadThumb($path);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）
        return ['status' => 0, 'result' => $result];
    }

    /**
     * @SWG\Get(path="/WxMediaApi/uploadArticle",
     *   tags={"微信素材"},
     *   summary="上传永久图文消息",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *     name="mediaId",
     *     in="query",
     *     description="mediaId",
     *     required=true,
     *     type="string"
     *   ),
     *  @SWG\Parameter(
     *     name="title",
     *     in="query",
     *     description="title",
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
    public function uploadArticle(Request $request)
    {
        $material = $this->app->material;
        $path = storage_path('hs.jpg');

        $article = new Article([
            'title' => $request->title,
            'thumb_media_id' => $request->mediaId,
        ]);

        $result = $material->uploadArticle($article);

        // 或者多篇图文
        //$material->uploadArticle([$article, $article2, ...]);

        return ['status' => 0, 'result' => $result];
    }

    /**
     * @SWG\Get(path="/WxMediaApi/get",
     *   tags={"微信素材"},
     *   summary="获取永久素材",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *     name="mediaId",
     *     in="query",
     *     description="mediaId",
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
    public function get(Request $request)
    {
        $material = $this->app->material;
        $resource = $material->get($request->mediaId);

        return ['status' => 0, 'resource' => $resource];
    }

    /**
     * @SWG\Get(path="/WxMediaApi/lists",
     *   tags={"微信素材"},
     *   summary="获取永久素材列表",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *     name="type",
     *     in="query",
     *     description="type",
     *     required=true,
     *     type="string"
     *   ),
     *     @SWG\Parameter(
     *     name="offset",
     *     in="query",
     *     description="offset",
     *     required=true,
     *     type="string"
     *   ),
     *     @SWG\Parameter(
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
    public function lists(Request $request)
    {

//        $type 素材的类型，图片（image）、视频（video）、语音 （voice）、图文（news）
//        $offset 从全部素材的该偏移位置开始返回，可选，默认 0，0 表示从第一个素材 返回
//        $count 返回素材的数量，可选，默认 20, 取值在 1 到 20 之间


        $material = $this->app->material;

        $lists = $material->lists($request->type, $request->offset, $request->count);

        return ['status' => 0, 'resource' => $lists];
    }

    /**
     * @SWG\Get(path="/WxMediaApi/stats",
     *   tags={"微信素材"},
     *   summary="获取素材计数",
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

    public function stats(Request $request)
    {

        $material = $this->app->material;

        $stats = $material->stats();

        // {
        //   "voice_count":COUNT,
        //   "video_count":COUNT,
        //   "image_count":COUNT,
        //   "news_count":COUNT
        // }

        return ['status' => 0, 'sattus' => $stats];
    }

    /**
     * @SWG\Get(path="/WxMediaApi/delete",
     *   tags={"微信素材"},
     *   summary="删除永久素材",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *     name="mediaId",
     *     in="query",
     *     description="mediaId",
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

        $material = $this->app->material;

        $stats = $material->delete($request->mediaId);

        // {
        //   "voice_count":COUNT,
        //   "video_count":COUNT,
        //   "image_count":COUNT,
        //   "news_count":COUNT
        // }

        return ['status' => 0, 'sattus' => $stats];
    }


    /**
     * @SWG\Get(path="/WxMediaApi/uploadImageTmp",
     *   tags={"微信素材"},
     *   summary="上传图片(临时素材 API)",
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
    public function uploadImageTmp(Request $request)
    {
        $temporary = $this->app->material_temporary;

        $path = storage_path('hs.jpg');
        $result = $temporary->uploadImage($path);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）
        return ['status' => 0, 'result' => $result];
    }


    /**
     * @SWG\Get(path="/WxMediaApi/uploadVoiceTmp",
     *   tags={"微信素材"},
     *   summary="上传音频(临时素材 API)",
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
    public function uploadVoiceTmp(Request $request)
    {
        $temporary = $this->app->material_temporary;
        $path = storage_path('6839.wav');
        $result = $temporary->uploadVoice($path);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）
        return ['status' => 0, 'result' => $result];
    }


    /**
     * @SWG\Get(path="/WxMediaApi/uploadVideoTmp",
     *   tags={"微信素材"},
     *   summary="上传视频(临时素材 API)",
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
    public function uploadVideoTmp(Request $request)
    {
        $temporary = $this->app->material_temporary;
        $path = storage_path('mp4.mp4');
        $result = $temporary->uploadVoice($path);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）
        return ['status' => 0, 'result' => $result];
    }

    /**
     * @SWG\Get(path="/WxMediaApi/uploadThumbTmp",
     *   tags={"微信素材"},
     *   summary="上传缩略图(临时素材 API)",
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
    public function uploadThumbTmp(Request $request)
    {
        $temporary = $this->app->material_temporary;
        $path = storage_path('hs.jpg');
        $result = $temporary->uploadThumb($path);  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）
        return ['status' => 0, 'result' => $result];
    }

    /**
     * @SWG\Get(path="/WxMediaApi/getStream",
     *   tags={"微信素材"},
     *   summary="获取临时素材内容(临时素材 API)",
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
    public function getStream(Request $request)
    {
        $temporary = $this->app->material_temporary;
        $content = $temporary->getStream($request->mediaId);
        return ['debug'=>'debug'];
    }

    /**
     * @SWG\Get(path="/WxMediaApi/download",
     *   tags={"微信素材"},
     *   summary="下载临时素材到本地(临时素材 API)",
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
    public function download(Request $request)
    {
        $temporary = $this->app->material_temporary;
        $content = $temporary->getStream($request->mediaId);
        return ['debug'=>'debug'];
    }

}
