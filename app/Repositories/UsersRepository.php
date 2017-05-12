<?php 

namespace App\Repositories;

use App\User;
use App\smscode;

class UsersRepository
{	
	#用户注册
	public function newUser($request)
	{
		 #手机号是否已注册
		$user = User::where(['phone'=>$request->phone])->first();
		if($user){
		    return ['message' => '该手机号已被使用，请更换手机号','status'=> 1];
		}

		#公司是否已注册
		$company = User::where(['name'=>$request->name])->first();
		if($company){
		    return ['message' => '该公司已注册过了，请重新填写公司名称','status'=> 2];
		}

		$code = $request->code; #验证码

		$cinfo = $this->checkCode($code,$request->phone); #判断验证码是否正确

		if($cinfo['status']){
			return $cinfo;
		}

		//如果openid已存在   在c端购买过流量
		$user = User::where('openid',$request->openid)->first();

		if($user){
			if($user->phone){
				return ['message' => '该微信号已注册过公司','status'=> 6];
			}else{  //因为在c端购买过流量 手机号为空 公司名也为空  所以有2种身份
				$user->phone = $request->phone;
				$user->name = $request->name;
				$user->save();
			}
		}else{ //新创一个账号
			$user = User::create([
				'openid'=> $request->openid,
				'name' => $request->name,
				'phone' => $request->phone
			]);
		}

		$token = createToken($user->id);
		return ['message' => '注册成功','status'=> 0,'token' =>$token];
	}

	#用户登录
	public function loginUser($request)
	{

        $user = User::where(['phone'=>$request->phone])->first();
        if(!$user){
            return ['message'=>'该账户不存在，请检查后重新输入','status'=>1];
        }else{
        	$cinfo = $this->checkCode($request->code,$request->phone); #判断验证码是否正确

			if($cinfo['status']){
				return $cinfo;
			}
        }
        $token = createToken($user->id);
        return ['message' => '登录成功','status'=> 0,'token' =>$token];

	}


	#判断验证码是否正确
	public function checkCode($code,$mobile)
	{
		$nowTimeStr = date('Y-m-d H:i:s'); #当前时间戳

		$smscodeObj = smscode::where(['mobile'=>$mobile])->first(); #查看数据库中是否有记录

        if($smscodeObj){
            $smsCodeTimeStr = $smscodeObj->updated_at;  #最后发送时间
            $recordCode = $smscodeObj->code;            #数据库中的短信验证码

            if($recordCode != $code){
                return ['message' => '验证码不正确','status'=> 3];
            }

            $nowTime = strtotime($nowTimeStr);          #转为时间戳
            $smsCodeTime = strtotime($smsCodeTimeStr);  #转为时间戳

            $period = floor(($nowTime-$smsCodeTime)/60); //60s

            //echo $nowTime.'--'.$smsCodeTime.'--'.$period;die;
            if($period >= 60){
            	
               return ['message' => '验证码已过期，请重新获取','status'=> 4];
            }else{
            	return ['message' => '验证码正确','status'=> 0];
            }
           
        }else{
             return ['message' => '请先获取验证码','status'=> 5];
        }
	} 

}
