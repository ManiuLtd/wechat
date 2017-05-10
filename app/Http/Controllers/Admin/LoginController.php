<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin;

class LoginController extends Controller
{
    public function login()
    {
    	return view('login.login');
    }

    public function doLogin(Request $request)
    {   
       
    	$name = $request->name;
    	$password = md5($request->password);

    	$admin = Admin::where(['name'=>$name,'password'=>$password])->first();

        if($admin){
           if($admin->status == '锁定中'){
                return redirect()->back()->with('status', '该账户已被禁用');
           }
           session(['admin' => $admin->toArray()]);
           return redirect()->route('admin.admin.index');
        }else{
            return redirect()->back()->with('status', '账号或密码错误');
        }

    }

    public function logout(Request $request)
    {   
        $request->session()->flush();
        return redirect()->route('login.login');
    }
}
