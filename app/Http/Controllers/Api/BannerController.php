<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use App\Banner;


class BannerController extends BaseController
{
    /**
     * @SWG\Get(path="/banner",
     *   tags={"Banner"},
     *   summary="Banner列表",
     *   description="",
     *   operationId="",
     *   produces={"application/xml", "application/json"},
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
    public function index(Request $request)
    {   
        $banners =  Banner::all()->map(function($i,$v){
       		return [
       			'name' =>$i->name,
       			'url' => config('qiniu.domain').$i->link,
       		];
        });
        
         return $this->response->array($banners->toArray());
    }


}
