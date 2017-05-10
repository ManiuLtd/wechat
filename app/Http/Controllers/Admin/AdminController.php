<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin;
use Redirect;
use App\Http\Requests\storeAdminRequest;
use App\Http\Requests\updateAdminRequest;

class AdminController extends Controller
{
 
    public function index()
    {     
        $admins = Admin::orderBy('id','desc')->paginate(7);
        return view('admin.admin.index',compact('admins'));
    }

   
    public function create()
    {
        return view('admin.admin.create');
    }

  
    public function store(storeAdminRequest $request)
    {
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->back()->with('status', '添加成功');
    }

  
    public function show($id)
    {
        //
    }


    public function edit($id)
    {   
        $admin = Admin::findOrFail($id);
        return view('admin.admin.edit',compact('admin'));
    }

   
    public function update(updateAdminRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;

        $pwd = $request->password;
        $repwd = $request->password_confirmation;
        if(($pwd == $repwd) && ($pwd && $repwd)){
            $admin->password = $request->password;
        }

        $admin->save();
        return redirect()->back()->with('status', '保存成功');
    }

 
    public function destroy($id)
    {
        Admin::destroy($id);
        return redirect()->back()->with('status', '删除成功');
    }

    public function status($id)
    {
        $admin = Admin::findOrFail($id);

        $status = ($admin->status == '正常') ? '1' : '0';
      
        $admin->status = $status;
        $admin->save();
        return Redirect::back();
    }
}
