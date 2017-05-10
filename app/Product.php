<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
    ];

    public function goods()
    {
    	return $this->hasMany('App\Good');
    }

    public function agents()
    {
    	return $this->belongsToMany('App\Aagent','product_agents', 'agent_id', 'product_id');
    }

   
}
