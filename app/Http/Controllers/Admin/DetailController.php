<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Detail;
use Excel;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
    	$datas = Detail::findOrFail($id)->useds()->paginate(10);
        return view('admin.detail.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

    public function export($id)
    {

        $header = ['请求id','使用手机号','商品销售id','商品名称','状态','时间'];
        $datas = Detail::findOrFail($id)->useds;

        $ds = $datas->map(function($i,$v){
            return [
                $i->reqId,
                $i->phone,
                $i->saleId,
                $i->detail->good->productName,
                $i->status,
                $i->created_at->format('Y-m-d H:i:s')              
            ];
        })->toArray();

        array_unshift($ds,$header);

        $cellData = $ds;

        Excel::create('订单使用明细',function($excel) use ($cellData){
            $excel->sheet('订单使用明细', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }
}
