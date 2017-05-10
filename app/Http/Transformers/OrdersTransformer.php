<?php

namespace App\Http\Transformers;

use App\Order;
use League\Fractal\TransformerAbstract;


class OrdersTransformer extends TransformerAbstract
{

    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform(Order $item)
    {   
        return [
            'id' => $item->id,
            'order_num' => $item->order_num,
            'status' => $item->status,
            'time' => $item->created_at->format('Y-m-d H:i:s'),
            'totalPrice' => $item->total,
            'details' => $item->details->map(function($i,$k) use($item){
                return [
                    'name' => $i->good->product->name,
                    'type' => $i->good->saleType,
                    'agent' => $i->good->agent->name,
                    'usedCnt' => $i->usedCnt,
                    'unUsedCnt' => $i->unUsedCnt,
                    'stock' => $i->stock,
                    'price' => $i->price,
                    'total' => $i->price * $i->stock,
                ];
            }),
        ];
    }

}