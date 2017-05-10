<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Good;
use App\Http\Requests\goodStoreRequest;
use App\Http\Requests\updateGoodRequest;
use App\Merchant;
use App\Agent;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $goods = Product::findOrFail($id)->goods()->get();
        //dd($goods);
        return view('admin.good.index',compact('goods','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   

        $pluck  = Merchant::select('name','id')->pluck('name','id');
        $product_pluck = Product::select('name','id')->pluck('name','id');
        $merchant_id = '';
        $agent_id = '';
        return view('admin.good.create',compact('id','pluck','merchant_id','agent_id','product_pluck'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(goodStoreRequest $request)
    {   
        $agent_id = $request->agent_id;
        $product_id = $request->product_id;
        Agent::findOrFail($agent_id)->products()->detach($product_id);
        Agent::findOrFail($agent_id)->products()->attach($product_id);
        Product::findOrFail($product_id)->goods()->create([
            'productName' => $request->productName,
            'productType' => $request->productType,
            'merchant_id' => $request->merchant_id,
            'agent_id' => $agent_id,
            'saleType' => $request->saleType,
            'saleId' => $request->saleId,
            'money' => $request->money,
            'oldMoney' => $request->oldMoney,
        ]);

        return redirect()->back()->with('status', '添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id,$id)
    {
        $good = Good::findOrFail($id);
        $saleType = ($good->saleType == '国内流量包' ? '1' : '0');
        $merchant_id = $good->agent->merchant->id;
        $agent_id = $good->agent->id;
        $product_pluck = Product::select('name','id')->pluck('name','id');
        $pluck  = Merchant::select('name','id')->pluck('name','id');

        return view('admin.good.edit',compact('good','product_id','saleType','pluck','id','merchant_id','agent_id','product_pluck'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateGoodRequest $request, $id)
    {
        
        $good = Good::findOrFail($id);

        $agent_id = $request->agent_id;
        $product_id = $request->product_id;
        //agent_id 变 product_id 也变
        if($good->agent_id != $agent_id && $good->product_id != $product_id ){
            Agent::findOrFail($agent_id)->products()->detach($product_id); //先删除
            Agent::findOrFail($agent_id)->products()->attach($product_id); //再添加
        }

        //agent_id变  product_id不变
        if($good->agent_id != $agent_id && $good->product_id == $product_id){
            Agent::findOrFail($agent_id)->products()->detach($product_id); //先删除
            Agent::findOrFail($agent_id)->products()->attach($product_id); //再添加
        }

        //agent_id不变  product_id变
        if($good->agent_id == $agent_id && $good->product_id != $product_id){
            Agent::findOrFail($agent_id)->products()->detach($product_id);
            Agent::findOrFail($agent_id)->products()->attach($product_id); //再添加
        }

        $good->productName = $request->productName;
        $good->productType = $request->productType;
        $good->agent_id = $request->agent_id;
        $good->merchant_id = $request->merchant_id;
        $good->product_id = $request->product_id;
        $good->saleId = $request->saleId;
        $good->saleType = $request->saleType;
        $good->money = $request->money;
        $good->save();

        return redirect()->back()->with('status', '编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
