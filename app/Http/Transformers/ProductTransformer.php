<?php

namespace App\Http\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{

    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform(Product $item)
    {
        return [
                'id' => $item->id,
                'name' => $item->name.'aa',
            	
        ];
    }

}