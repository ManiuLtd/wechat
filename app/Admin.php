<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    
    protected $fillable = [
        'name', 'email','password'
    ];

    protected $hidden = [
        'password'
    ];


   	//获取管理员状态
   	public function getStatusAttribute($value)
   	{
   		if($value){
   			return '锁定中';
   		}else{
   			return '正常';
   		}
   	}

   	//定义修改器 设置密码md5
   	public function setPasswordAttribute($value)
   	{
   		$this->attributes['password'] = md5($value);
   	}
}
