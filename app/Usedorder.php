<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usedorder extends Model
{
    protected $fillable = [
    	'user_id','order_id','reqId','phone','saleId','goodId','type','status'
    ];

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function detail()
    {
    	return $this->belongsTo('App\Detail');
    }
}
