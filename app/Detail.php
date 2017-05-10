<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{   
    public $timestamps = false;
    
    protected $fillable = [
        'order_id','good_id','productName','productType','stock','price','expDate','usedCnt','unUsedCnt'
    ];

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function good()
    {
    	return $this->belongsTo('App\Good');
    }

    public function useds()
    {
        return $this->hasMany('App\Usedorder');
    }
  
}
