<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{	

	protected $fillable = ['name','merchant_id'];

    public function merchant()
    {
    	return $this->belongsTo('App\Merchant');
    }

   	public function products()
   	{
   		return $this->belongsToMany('App\Product','product_agents', 'agent_id', 'product_id');
   	}

   	public function goods()
   	{
   		return $this->hasMany('App\Good');
   	}


}
