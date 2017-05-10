<?php 

namespace App\Repositories;
use App\libs\DES;
use App\libs\Http;


class CommonRepository
{	
	//调用api获取库存
	public function lxStock()
	{	
		//请求参数拼接
		$input="accNbr=15365101520;actionCode=order_qixin_003;ztInterSource=200456";

        return $this->com($input);
	}

	//调用api购买普通包
	public function lxBuy($request)
	{	
		//请求id
		$reqId = $request->reqId; 
  		//手机号
        $accNbr = $request->accNbr; 
        //销售品id
        $offerSpecl = $request->offerSpecl;
        //商品名称 
        $goodName = $request->goodName;
        //请求参数拼接
        $input="reqId=".$reqId.";accNbr=".$accNbr.";offerSpecl=".$offerSpecl.";actionCode=order_qixin_001;goodName=".$goodName.";ztInterSource=200456;staffValue=15365101520;type=1";
       
        return $this->com($input,2);
	}

	//调用api，根据请求id查询交易状态
	public function queryOrder($request)
	{	
		$reqId = $request->reqId;
		//请求参数拼接
        $input="accNbr=15365101520;actionCode=order_qixin_006;ztInterSource=200456;reqId={$reqId}";

        return $this->com($input,3);
	}

	//调用api，对账
	public function checkAccount($request)
	{
		//请求id	
		$date = $request->date;
        $dateType = $request->dateType;

        //请求参数拼接
        $input="accNbr=15365101520;actionCode=order_qixin_005;ztInterSource=200456;date=".$date.";dateType=".$dateType;

     	return $this->com($input,4);
	}

	//库存同步接口
	public function queryStock()
	{
		$input = "accNbr=15365101520;actionCode=order_qixin_003;ztInterSource=200456";
		return $this->com($input,5);
	}

	//通过商品销售id查看库存
	public function singleStock($request)
	{
		$saleId = $request->saleId;
		
		$arr = $this->lxStock();

		return $collection = collect($arr['data'])->where('saleId',$saleId)->groupBy('saleId')->map(function($i,$v){
            return $i->sum('unusedCnt');
        });
	}

	public function singleStockByParam($saleId)
	{
		
		$arr = $this->lxStock();
		return $collection = collect($arr['data'])->where('saleId',$saleId)->groupBy('saleId')->map(function($i,$v){
            return $i->sum('unusedCnt');
        });
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
