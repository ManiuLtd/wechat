<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
	protected $fillable = [
        'user_id', 'req_id','total','status','order_num','remarks'
    ];


    public function user()
    {
    	return $this->belongsTo('App\User');
    }

	public function details()
	{
		return $this->hasMany('App\Detail');
	}

    public function useds()
    {
        return $this->hasMany('App\Usedorder');
    }

    public function getStatusAttribute($value)
    {
    	if($value == 0){
    		return '未支付';
    	}elseif($value == 1){
    		return '支付成功';
    	}else{
    		return '支付失败';
    	}
    }
}
