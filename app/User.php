<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'wx_num','phone','role_id','openid','wx_nickname','head_img','city','sex','province','name','status'
    ];

    //获取管理员状态
   	public function getStatusAttribute($value)
   	{
   		if($value){
   			return '审核通过';
   		}else{
   			return '未审核';
   		}
   	}

    public function details()
    {
      return $this->hasManyThrough('App\Detail', 'App\Order');
    }


    public function orders()
    {
    	return $this->hasMany('App\Order');
    }

    public function porders()
    {
      return $this->hasMany('App\Personorder');
    }

}
