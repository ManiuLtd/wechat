<?php 
	
	#随机生成4位短信验证码
	function createSMSCode($length = 4){
	    $min = pow(10 , ($length - 1));
	    $max = pow(10, $length) - 1;
	    return rand($min, $max);
	}

	#获取短信验证码
	function getSMSCode($mobile){

	    // create curl resource 
	    $ch = curl_init(); 

	    // set url
	    $url = 'https://sms.yunpian.com/v1/sms/send.json'; 
	    curl_setopt($ch, CURLOPT_URL, $url); 

	    // set param
	    $mobile = $mobile;
	    $code = createSMSCode();
	    $paramArr = array(
	        'apikey' => config("yunpian.apikey"),
	        'mobile' => $mobile,
	        'text' => '【欢乐诵】您的验证码是'.$code
	    );
	    $param = '';
	    foreach ($paramArr as $key => $value) {
	        $param .= urlencode($key).'='.urlencode($value).'&';
	    }
	    $param = substr($param, 0, strlen($param)-1);

	    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书下同
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	    $output = curl_exec($ch); 

	    curl_close($ch); 
	  	
	    $outputArr = json_decode($output, true);
	   	
	    $arr = array(
	    	'output' => $outputArr,
	    	'code' => $code
	    );
	    return $arr; 
	}

	#订单号生成
	function orderNum()
	{
		$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
		$orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
		return date('YmdHis').$orderSn;
	}

	#生成token
	function createToken($uid)
	{	
		$key = "my_key";
		$token = array(
			"uid" => $uid,
            "iss" => "http://mycom.cn",
            "aud" => "http://mycom.cn",
            "iat" => time(),
            "nbf" => time(),
            "exp" => time()+3600,
        );

        $jwt = \Firebase\JWT\JWT::encode($token, $key);

        return $jwt;
	}

	#判断token是否有效
	function checkToken($token)
	{
		$key = "my_key";
		$decoded = \Firebase\JWT\JWT::decode($token, $key, array('HS256'));
		return (array)$decoded;
	}

	#随机数生成
	function randNum(){
		$arr=range(1,10);
		shuffle($arr);
		$str = implode('',$arr);
		return $str;
	}
		

	#http_request 方法
	function https_request($url)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl);
		if (curl_errno($curl)) {return 'ERROR '.curl_error($curl);}
		curl_close($curl);
		return $data;
	}

	#获取用户信息
	function getUserInfo($code)
	{
		$appid = "wx8a1874c6220e55ea";
		$appsecret = "47a1ad098864867d27e1d7172f5972b6";

	    //oauth2的方式获得openid
		$access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
		$access_token_json = https_request($access_token_url);
		$access_token_array = json_decode($access_token_json, true);
		$openid = $access_token_array['openid'];

	    //非oauth2的方式获得全局access token
	    $new_access_token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
	    $new_access_token_json = https_request($new_access_token_url);
		$new_access_token_array = json_decode($new_access_token_json, true);
		$new_access_token = $new_access_token_array['access_token'];
	    
	    //全局access token获得用户基本信息
	    $userinfo_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$new_access_token&openid=$openid";
		$userinfo_json = https_request($userinfo_url);
		$userinfo_array = json_decode($userinfo_json, true);
		return $userinfo_array;
	}

	//获取微笑openid
	function getOpenid($code)
	{
		$appid = "wx8a1874c6220e55ea";
		$appsecret = "47a1ad098864867d27e1d7172f5972b6";

	    //oauth2的方式获得openid
		$access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
		$access_token_json = https_request($access_token_url);
		$access_token_array = json_decode($access_token_json, true);
		$openid = $access_token_array['openid'];
		return  $openid;
	}

	//七牛云 upToken
	function generateUpToken()
	{
		$bucket = config("qiniu.bucket");
        $accessKey = config("qiniu.accessKey");
        $secretKey = config("qiniu.secretKey");
        $auth = new \Qiniu\Auth($accessKey, $secretKey);
        
        $policy = array(
              'returnUrl' => 'http://laravel.ana51.com/bannerCallback',
              'returnBody' => '{"fname":"$(fname)", "fkey":"$(key)", "name":"$(x:name)", "id":"$(x:id)", "oldLink":"$(x:oldLink)"}'
        );

        return $auth->uploadToken($bucket, null, 3600, $policy);
	}





























 ?>