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

    public function index()
    {
        $agents = Agent::all();
        return view('admin.agent.index', compact('agents'));
    }

    public function create()
    {
        $pluck = Merchant::select('name', 'id')->pluck('name', 'id');

        return view('admin.agent.create', compact('pluck'));
    }

    public function store(Request $request)
    {
        Agent::create([
            'merchant_id' => $request->merchant_id,
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', '添加成功');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $agent = Agent::findOrFail($id);
        $pluck = Merchant::select('name', 'id')->pluck('name', 'id');
        return view('admin.agent.edit', compact('agent', 'pluck'));
    }

    public function update(Request $request, $id)
    {
        $agent = Agent::findOrFail($id);
        $agent->merchant_id = $request->id;
        $agent->name = $request->name;
        $agent->save();
        return redirect()->back()->with('status', '编辑成功');
    }

    public function destroy($id)
    {
        //
    }

    public function goods($id)
    {
        $goods = Agent::findOrFail($id)->goods()->get();
        return view('admin.agent.goods', compact('goods', 'id'));
    }

    public function ajax_products(Request $request)
    {
        $products = Agent::findOrFail($request->id)->products()->get();
        $id = $request->id;
        $products->map(function ($i, $v) use ($id) {
            return $i->goods->where('agent_id', $id);
        });
        echo $products;
    }
}
