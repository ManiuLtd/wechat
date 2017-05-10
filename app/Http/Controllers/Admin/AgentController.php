<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Agent;
use App\Merchant;
use App\Http\Requests\storeAgentRequest;
use App\Http\Requests\updateAgentRequest;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = Agent::all();
        return view('admin.agent.index',compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
    	$pluck  = Merchant::select('name','id')->pluck('name','id');
    	
        return view('admin.agent.create',compact('pluck'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Agent::create([
            'merchant_id' => $request->merchant_id,
            'name' => $request->name
        ]);

        return redirect()->back()->with('status','添加成功');
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
        $agent = Agent::findOrFail($id);
        $pluck  = Merchant::select('name','id')->pluck('name','id');
        return view('admin.agent.edit',compact('agent','pluck'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agent = Agent::findOrFail($id);
        $agent->merchant_id = $request->id;
        $agent->name = $request->name;
        $agent->save();
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
        //
    }

    public function goods($id)
    {
        $goods = Agent::findOrFail($id)->goods()->get();
        return view('admin.agent.goods',compact('goods','id'));
    }

    public function ajax_products(Request $request){

        $products = Agent::findOrFail($request->id)->products()->get();
        $id = $request->id;
        $products->map(function($i,$v) use($id){
            return $i->goods->where('agent_id',$id);
        });
        echo $products;
    }
}
