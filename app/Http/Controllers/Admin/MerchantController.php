<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Merchant;
use App\Http\Requests\storeMerchantRequest;
use App\Http\Requests\updateMerchantRequest;
use App\Agent;
class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchants = Merchant::all();
        return view('admin.merchant.index',compact('merchants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.merchant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeMerchantRequest $request)
    {
        Merchant::create(['name'=>$request->name]);
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
    public function edit($id)
    {
        $merchant = Merchant::findOrFail($id);
        return view('admin.merchant.edit',compact('merchant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateMerchantRequest $request, $id)
    {
        $merchant = Merchant::findOrFail($id);
        $merchant->name = $request->name;
        $merchant->save();
        return redirect()->back()->with('status','编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Merchant::destroy($id);
        return redirect()->back()->with('status','删除成功');
    }

    public function agents($id)
    {
        $agents = Merchant::findOrFail($id)->agents()->get();


        return view('admin.merchant.agent',compact('agents'));
    }


    public function ajax_agents(Request $request){

        $agents = Merchant::findOrFail($request->id)->agents()->select('name','id')->get();
        echo $agents;
    }
}
