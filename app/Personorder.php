<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personorder extends Model
{
    protected $fillable = [
        'user_id', 'phone','good_id','status','order_num','order_num','price',
    ];


    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function good()
    {
    	return $this->belongsTo('App\Good');
    }
}

