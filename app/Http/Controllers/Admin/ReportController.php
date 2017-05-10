<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Detail;
use App\User;
use App\Product;
use App\Merchant;
use App\Agent;
use App\Order;
use DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {	

        #条件数据
        $users = User::get();
        $products = Product::get();
        $merchants = Merchant::get();
        $agents = Agent::get();

        #接受参数
    	$user_id = $request->user_id; #用户id
        $product_id = $request->product_id; #产品id
        $merchant_id = $request->merchant_id; #运营商id
        $agent_id = $request->agent_id; #代理商id
        $start_time = $request->start_time; #代理商id
    	$end_time = $request->end_time; #代理商id

    	
    	$orders = Order::where(['user_id'=>$user_id])->get();

      

    	$datas = DB::table('orders')
                        ->leftJoin('users',function($join){
                            $join->on('orders.user_id','=','users.id');
                        })
    					->rightJoin('details',function($join){
    						$join->on('orders.id','=','details.order_id');
    					})
                        ->leftJoin('goods',function($join){
                            $join->on('details.good_id','=','goods.id');
                        })->leftJoin('products',function($join){
                            $join->on('goods.product_id','=','products.id');
                        })->leftJoin('agents',function($join){
                            $join->on('goods.agent_id','=','agents.id');
                        })
                        ->leftJoin('merchants',function($join){
                            $join->on('agents.merchant_id','=','merchants.id');
                        })
                        ->where(function($query) use($product_id,$merchant_id,$agent_id,$user_id,$start_time,$end_time){
                            if($product_id){
                                $query->where('goods.product_id','=',$product_id);
                            }

                            if($merchant_id){
                                $query->where('goods.merchant_id','=',$merchant_id);
                            }

                            if($agent_id){
                                $query->where('goods.agent_id','=',$agent_id);
                            }

                            if($user_id){
                                $query->where('orders.user_id','=',$user_id);
                            }

                            if($start_time){
                                $query->where('orders.created_at','>=',$start_time);
                            }

                            if($end_time){
                                $query->where('orders.created_at','<=',$end_time);
                            }
                        })
                        ->select('agents.name as agent_name','merchants.*','goods.*','products.*','products.name as product_name','orders.*','orders.created_at as order_time','users.*','details.*','details.id as detail_id','merchants.name as merchant_name')
    					->get();

    
    
       return view('admin.report.index',compact('details','users','products','merchants','orders','agents','datas'));
    }
}
