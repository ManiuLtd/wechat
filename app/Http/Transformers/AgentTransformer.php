<?php

namespace App\Http\Transformers;

use App\Agent;
use League\Fractal\TransformerAbstract;

class AgentTransformer extends TransformerAbstract
{

    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform(Agent $item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'products' => $item->products->map(function($i,$k) use($item){
            	return [
                    [   
                        'name' => $i->name,
                        'sprice' => $i->goods()->where('agent_id',1)->where('saleType',0)->first()->money,
                        'goods'=>$i->goods->where('agent_id',"{$item->id}")->map(function($i,$v){
                            return [    
                                'id' => $i->id,
                                'product_id' => $i->product_id,
                                'agent_id' => $i->agent_id,
                                'merchant_id' => $i->merchant_id,
                                'saleId' => $i->saleId,
                                'saleType' => $i->saleType,
                                'status' => $i->status,
                                'money' => $i->money,
                                'oldMoney' => $i->oldMoney,
                               // 'stocks' => implode('',array_values($this->singleStock($i->saleId)))
                                'stocks' => 100,
                            ];
                        })
                    ]
                ];
             })->collapse(),
        ];
    }


    public function singleStock($saleId)
    {
   
        $curl = new \Curl\Curl();
        $curl->get('http://laravel.ana51.com/api/lxStock');
        $arr = json_decode($curl->response,true);

        $c = $collection = collect($arr['data'])->where('saleId',$saleId)->groupBy('saleId')->map(function($i,$v){
            return $i->sum('unusedCnt');
        })->toArray();

        return $c;
    }


}