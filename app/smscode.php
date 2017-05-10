<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class smscode extends Model
{
    protected $fillable = [
        'code', 'mobile'
    ];
}
