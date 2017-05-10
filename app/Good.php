<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{	
	  protected $fillable = [
        'productName','productType','saleId','money','saleType','merchant_id','agent_id','oldMoney'
    ];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function agent()
    {
      return $this->belongsTo('App\Agent');
    }

    public function merchant()
    {
      return $this->belongsTo('App\Merchant');
    }

    public function details()
    {
      return $this->hasMany('App\Detail');
    }

    // 	//获取管理员状态
   	// public function getSaleTypeAttribute($value)
   	// {
   	// 	if($value){
   	// 		return '国内流量包';
   	// 	}else{
   	// 		return '省内流量包';
   	// 	}
   	// }

    public function porders()
    {
      return $this->hasMany('App\Personorder');
    }
}
