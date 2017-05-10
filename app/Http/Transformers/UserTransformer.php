<?php

namespace App\Http\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;
use DB;
use App\Good;


class UserTransformer extends TransformerAbstract
{

    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform(User $item,$user_id)
    {
        return [
            // 'name' => $item->name,
            // 'desc' => '企业用户流量库存',
            // 'details' => $item->details->filter(function($i,$v){
            //         if($i->good->agent_id == '1' && $i->good->saleType == '国内流量包'){
            //             return true;
            //         }
            // }) 
            // ->groupBy(function ($item, $key) {
            //     return Good::findOrFail($item['good_id'])->product->name;
            // })
            // ->map(function($i,$v){
            //         return $i->sum('unUsedCnt');
            // })                   
        ];
    }

}