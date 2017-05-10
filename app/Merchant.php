<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{	
	protected $fillable = ['name','code'];

    public function agents()
    {
    	return $this->hasMany('App\Agent');
    }

    public function goods()
    {
    	return $this->hasMany('App\Good');
    }
}
