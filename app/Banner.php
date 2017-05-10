<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
    	'name','link'
    ];


    // public function getLinkAttribute($value)
   	// {
   	// 	return config("qiniu.domain").$value;
   	// }
}
