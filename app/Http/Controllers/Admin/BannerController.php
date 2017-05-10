<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Banner;
use Qiniu\Auth;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $banners = Banner::all();
        return view('admin.banner.index',compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $upToken = generateUpToken();
        $banner = '';
        return view('admin.banner.create',compact('upToken','banner'));
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
        $banner = Banner::findOrFail($id);
        $upToken = generateUpToken();
        return view('admin.banner.edit',compact('banner','upToken'));
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
        Banner::destroy($id);
        return redirect()->back()->with('status', '删除成功');
    }

    public function bannerCallback(Request $request)
    {
        $json_ret = base64_decode($request->upload_ret);
        $result=json_decode($json_ret,true);

        if($result['id'] && $result['fname']){
            $banner = Banner::findOrFail($result['id']);
            $banner->link = $result['fkey'];
            $banner->name = $result['name'];
            $banner->save();
        }elseif($result['id'] && !$result['fname']){
            $banner = Banner::findOrFail($result['id']);
            $banner->link = $result['oldLink'];
            $banner->name = $result['name'];
            $banner->save();
        }else{
             Banner::create([
                'name' => $result['name'],
                'link' => $result['fkey']
            ]);
        }

        return redirect()->route('admin.banner.index')->with('添加成功');
    }
}
