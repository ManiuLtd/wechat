<?php

namespace App\Http\Controllers\Pchome;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;


class IndexController extends Controller
{
    public function index()
    {	
    	$products = Product::has('goods')->get();
    	return view('pchome.index.index',compact('products'));
    }
}
