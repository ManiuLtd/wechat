<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class WxController extends Controller
{
    public function oauth(Request $request)
    {	
    	$code = $request->code;
    	$state = $request->state;
        $openid = '';
    	//只获取openid
    	if($state == 0 || $state == 1){
    		$openid = getOpenid($code);
			$user = User::where('openid',$openid)->first();	

			if(!$user){
				User::create([ 'openid' => $openid ]);
			}

    	}else{ //获取用户详情
    		$userinfo = getUserInfo($code);
            $openid = $userinfo['openid'];
    		$user = User::where('openid',$userinfo['openid'])->first();
    		$user->wx_nickname = $userinfo['nickname'];
    		$user->sex = $userinfo['sex'];
    		$user->province = $userinfo['province'];
    		$user->city = $userinfo['country'];
    		$user->head_img = $userinfo['headimgurl'];
    	}

		if($state == 0){ //个人购买
			$url = "http://lx.ana51.com/toC/index.html?openid=$openid";
		}elseif($state == 1){
			$url = "http://lx.ana51.com/register/index.html?openid=$openid";
		}elseif($state == 2){
			$url = "http://lx.ana51.com/stock-c/index.html?openid=$openid";
		}elseif($state == 3){
			$url = "http://lx.ana51.com/stock-b/index.html?openid=$openid";
		}

    	return view('oauth2',compact('url'));
    }

}
