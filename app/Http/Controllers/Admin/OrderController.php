<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Detail;
use App\Merchant;
use App\Agent;
use App\Product;
use App\Order;
use App\Good;
use DB;
use Redirect;


class OrderController extends Controller
{
 
    public function index($id)
    {
        $orders = User::findOrFail($id)->orders()->orderBy('id','desc')->paginate(7);
        $user_id = $id;
        return view('admin.order.index',compact('orders','user_id'));
    }

  
    public function create(Request $request)
    {   
        $user_id = $request->id;
        $merchants = Merchant::all();
        return view('admin.order.create',compact('merchants','user_id'));
    }

  
    public function store(Request $request)
    {
        $ids = $request->ids;

        if(!$ids){
            return redirect()->back()->with('status', '请选择商品');
        }

        $remarks = $request->remarks;
        $data = [];
        $total = 0;

        foreach($ids as $k=>$v){
            $tmp = "val-{$v}";
            $val = $request->$tmp;

            if(!$val){ continue; }

            $price = Good::findOrFail($v)->money;
            $saleId = Good::findOrFail($v)->saleId;
            $total += $val*$price;

            array_push($data, ['good_id'=>$v,'stock'=>$val,'saleId'=>$saleId, 'price'=>$price,'usedCnt'=>0,'unUsedCnt'=>$val]);
        }


        $user = User::findOrFail($request->user_id);

        DB::transaction(function () use($user,$total,$data, $remarks){
            $order = $user->orders()->create([
                'order_num' => orderNum(),
                'total' => $total,
                'status' => 1,
                'remarks' => $remarks,
            ]);

            foreach($data as $val){
                $details = new Detail($val);
                $order->details()->save($details);
            }
        });

        return redirect()->back()->with('status', '创建订单成功');
    }

   
    public function show($user_id,$order_id)
    {
        $details = Order::findOrFail($order_id)->details()->get();
        //dd($details);
        return view('admin.order.show',compact('details'));
    }

   
    public function edit($id)
    {
        
    }

  
    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        //
    }

    #库存
    public function stock(Request $request,$id)
    {
    	
        $agent_id = $request->agent_id;
        $merchant_id = $request->merchant_id;
        $product_id = $request->product_id;

        $merchants  = Merchant::all();
        $agents = Agent::all();
        $products = Product::all();

        $datas = DB::table('users')
            ->Join('orders',function($join) use($id){
                $join->on('orders.user_id','=','users.id')->where('users.id','=',$id)->where('orders.status','=','1');
            })
            ->leftJoin('details',function($join){
                $join->on('details.order_id','=','orders.id');
            })
            ->leftJoin('goods',function($join){
                $join->on('details.good_id','=','goods.id');
            })->leftJoin('products',function($join){
                $join->on('goods.product_id','=','products.id');
            })
            ->where(function($query) use($product_id,$merchant_id,$agent_id){
                if($product_id){
                    $query->where('goods.product_id','=',"{$product_id}");
                }

                if($merchant_id){
                    $query->where('goods.merchant_id','=',"{$merchant_id}");
                }

                if($agent_id){
                    $query->where('goods.agent_id','=',"{$agent_id}");
                }
            })
           ->groupBy('good_id')
           ->select('details.*','goods.productName as productName','goods.saleType' ,'products.name as product_name',DB::raw('SUM(usedCnt) as totalUsedCnt,SUM(unUsedCnt) as totalUnusedCnt, SUM(stock) as totalStock'))
           ->get();

       
       
        return view('admin.order.stock',compact('datas','agents','merchants','products','id'));
    }

    public function status($id)
    {
        $order = Order::findOrFail($id);

        $status = ($order->status == '未支付') ? '1' : '0';
      
        $order->status = $status;
        $order->save();
        return Redirect::back();
    }
}
