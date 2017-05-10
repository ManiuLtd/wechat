<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Api\BaseController;
use App\Http\Transformers\ProductTransformer;
use App\Http\Transformers\AgentTransformer;
use App\Agent;
use App\Product;
class ProductController extends BaseController
{


    
    
    /**
     * @SWG\Get(path="/product/getProductsByAgent",
     *   tags={"流量包"},
     *   summary="根据代理商id获取流量包",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="agent_id",
     *     in="query",
     *     description="代理商id(如: id=1 为江苏电信)",
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
    public function getProductsByAgent(Request $request)
    {
       	$id = $request->agent_id;
        

        $agent = Agent::findOrFail($id);

    
        return $this->response->item($agent,new AgentTransformer);


    }

    /**
     * @SWG\Get(path="/product/getProductsByAgentName",
     *   tags={"流量包"},
     *   summary="根据代理商名称获取流量包",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *  @SWG\Parameter(
     *     name="agent_name",
     *     in="query",
     *     description="代理商名称(如:为江苏电信)",
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
    public function getProductsByAgentName(Request $request)
    {
        
        $agent = Agent::where('name',$request->agent_name)->first();

        if($agent){
            return $this->response->item($agent,new AgentTransformer);
        }else{
            return $this->response->array(['status'=>1,'msg'=>'找不到数据']);
        }
    
    
    }
}
