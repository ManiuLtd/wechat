<?php 

namespace App\Repositories;
use App\libs\DES;
use App\libs\Http;

class ForeignRepository
{	

	//ToB查询交易状态接口
    public function queryOrder($request)
    {   
        $reqId = $request->reqId;
        //请求参数拼接
        $input="accNbr=15365101520;actionCode=order_qixin_006;ztInterSource=200456;reqId={$reqId}";
        return $this->com($input,3);
    }

    //调用api购买普通包
    public function lxBuy($reqId,$accNbr,$offerSpecl,$goodName)
    {   
       
        $input="reqId=".$reqId.";accNbr=".$accNbr.";offerSpecl=".$offerSpecl.";actionCode=order_qixin_001;goodName=".$goodName.";ztInterSource=200456;staffValue=15365101520;type=1";
       
        return $this->com($input,2);
    }

    //公共方法
    public function com($input,$type=1)
    {   
        switch ($type) {
            case 1:
              $send_package_url = 'http://221.228.39.33/llfx/jszt/ipauth/queryStock';
              break;
            case 2:
              $send_package_url = 'http://221.228.39.33/llfx/jszt/ipauth/orderPackageByQiXin';
              break;
            case 3:
              $send_package_url = 'http://221.228.39.33/llfx/jszt/ipauth/queryOrder';
              break;
            case 4:
              $send_package_url = 'http://221.228.39.33/llfx/jszt/ipauth/checkAccount';
              break;
            case 5:
              $send_package_url = 'http://221.228.39.33/llfx/jszt/ipauth/queryStock';
              break;
        }

        $cert_path = storage_path('app/jszt.cer');
        $des = new DES($cert_path);
        $post_data =  "para=" . urlencode($des->encrypt($input));
        $ret = Http::post($send_package_url, $post_data);
        $resp = json_decode($ret, true);
        return $resp;
    }

}
