<?php

namespace App\Http\Transformers;

use App\Personorder;
use League\Fractal\TransformerAbstract;


class PersonordersTransformer extends TransformerAbstract
{

    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform(Personorder $item)
    {   
        return [
            'totalMoney' => $item->user->porders->sum('price'),
            'totalCount' => $item->user->porders->count(),
            'name' => $item->user->wx_nickname,
            'pic' => $item->user->head_img,
            'orders' => [
                'id' => $item->id,
                'phone'=>$item->phone,
                'order_num'=>$item->order_num,
                'name'=>$item->good->product->name,
                'time'=>$item->created_at->format('Y-m-d H:i'),
                'saleType' => $item->good->saleType ? '全国' : '省内',
                'price'=>$item->price,
                'status'=>$item->status,

            ],

        ];
    }

}