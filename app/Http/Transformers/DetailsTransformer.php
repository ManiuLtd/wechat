<?php

namespace App\Http\Transformers;

use App\Detail;
use League\Fractal\TransformerAbstract;


class DetailsTransformer extends TransformerAbstract
{

    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform(Detail $item)
    {   
        return [
            'name' => $item->good->product->name,
            'saleType' => $item->good->saleType,
            'agent' => $item->good->agent->name,
            'totalUsedCnt' => $item->totalUsedCnt,
            'unUsedCnt' => $item->totalUnsedCnt,
            'totalStock' => $item->totalStock,
        ];
    }

}