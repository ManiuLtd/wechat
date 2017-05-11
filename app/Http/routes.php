<?php


//swagger doc
Route::get('/swagger/doc', 'SwaggerController@doc');


//wechat
Route::any('/wechat','WechatController@index'); //服务器验证
Route::any('/oauth_callback','WechatController@oauth_callback'); //回调页面
Route::any('/oauth','WechatController@oauth'); //发起授权


//test测试专用
Route::get('/test','WechatController@test');



//七牛上传回调
Route::any('/bannerCallback','Admin\BannerController@bannerCallback');



//后台
Route::group(['namespace'=>'Admin','middleware'=>'admin','prefix'=>'admin'],function(){

	### Excel ###
	Route::get('detail/export/{id}',[
	'as' => 'admin.details.export', 'uses' => 'DetailController@export'
	]);

	###  报表 ###
	Route::get('report',[
		'as' => 'order.report', 'uses' => 'ReportController@index'
	]);
	

	//运营商相关
	### 运营商
	Route::resource("merchant","MerchantController");

	### 运营商下的代理商 ###
	Route::get('merchant/{id}/agents',[
		'as' => 'admin.merchant.agents','uses' =>'MerchantController@agents'
	]);

	### ajax 根据merchant_id 获取agents
	Route::post('merchant/ajax_agents',[
		'as' => 'admin.merchant.ajax_agents','uses' =>'MerchantController@ajax_agents'
	]);






	//代理商相关
	### 代理商 ###
	Route::resource("agent","AgentController");

	### 根据agent_id 获取 products
	Route::post('agent/ajax_products',[
		'as' => 'admin.agent.ajax_products','uses' =>'AgentController@ajax_products'
	]);

	### 代理商下的所有商品 ###
	Route::get('agent/{id}/products',[
		'as' => 'admin.agent.goods', 'uses' => 'AgentController@goods'
	]);





	### 用户订单汇总 ###
	Route::get("user/{id}/order",[
		'as' => 'admin.user.order','uses' => 'OrderController@index'
	]);

	### 个人订单
	Route::get('users/{id}/porder',[
		'as' => 'admin.user.porder','uses' => 'PersonorderController@index'
	]);





	### 订单状态
	Route::post('order/{id}/status',[
	    'as' => 'admin.order.status', 'uses' => 'OrderController@status'
	]);

	### 订单详情
	Route::get('user/{user_id}/order/{order_id}',[
		'as' => 'admin.user.order.details','uses' => 'OrderController@show'
	]);


	### 创建订单
	Route::post('order',[
		'as' => 'admin.user.order.store','uses' => 'OrderController@store'
	]);


	Route::get('/admin','AdminController@index');






	### admin ###
	Route::resource('admin','AdminController');

	### banner ###
	Route::resource('banner','BannerController');

	### product ###
	Route::resource('product','ProductController');


	//管理员相关
	### 管理员状态 ###
	Route::post('admin/{id}/status',[
	    'as' => 'admin.status', 'uses' => 'AdminController@status'
	]);

	### 管理员退出 ###
	Route::get('login/logout',[
		'as' => 'login.logout', 'uses' => 'LoginController@logout'
	]);


	//商品相关
	###  流量商品 ###
	Route::get("product/{id}/good",[
		'as' => 'good.index','uses'=>'GoodController@index'
	]);

	Route::get("product/{id}/good/create",[
		'as' => 'good.create','uses'=>'GoodController@create'
	]);

	Route::post("product/{id}/good/store",[
		'as' => 'good.store','uses'=>'GoodController@store'
	]);

	Route::get("product/{product_id}/good/{id}/edit",[
		'as' => 'good.edit','uses'=>'GoodController@edit'
	]);

	Route::patch("good/update/{id}",[
		'as' => 'good.update','uses'=>'GoodController@update'
	]);



	//企业用户相关

	###  企业用户 ###
	Route::resource('user','UserController');

	### 企业状态 ###
	Route::post('admin/user/{id}/status',[
		'as' => 'admin.user.status', 'uses' => 'UserController@status'
	]);

	### 用户库存 ###
	Route::get("user/{id}/stock",[
		'as' => 'admin.user.stock','uses' => 'OrderController@stock'
	]);

	###订单使用详情
	Route::get('/details/{id}',[
		'as' => 'admin.detail.useds','uses'=>'DetailController@index'
	]);

	### 后台为用户创建订单
	Route::get('user/{id}/buy',[
		'as' => 'admin.user.buy', 'uses' => 'OrderController@create'
	]);


});


//admin后台登录 处理登录
Route::get('/login',[ 'as' => 'login.login', 'uses' => 'Admin\LoginController@login']);
Route::post('/doLogin','Admin\LoginController@doLogin');



//api相关
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api'], function ($api) {
        $api->group(['middleware'=>['api.cors']], function ($api) {



			//用户相关
			$api->get('/register','UserController@register'); 		#企业用户注册
			$api->get('/login','UserController@login'); 			#企业用户登录
			$api->post('/buy','UserController@buy');    //用户购买流量接口
			$api->get('/personorders','UserController@personorders'); //根据openid获取ToC订单
            $api->post('/batchBuy','UserController@batchBuy'); 		#企业批量购买流量
            $api->get('/orders','UserController@orders'); 			#企业订单订购记录
            $api->get('/stocks','UserController@stocks'); 			#根据token获取企业流量包库存


            //企业调用接口
            $api->post('/orderBuy','ForeignController@orderBuy'); 		#使用流量
            $api->get('/qOrder','ForeignController@queryOrder'); 		#使用流量



            //流量平台给的接口 公共接口
            $api->get('/lxStock','CommonController@lxStock'); 			#lx库存
            $api->post('/lxBuy','CommonController@lxBuy'); 				#购买流量
            $api->get('/queryOrder','CommonController@queryOrder'); 	#订购查询
            $api->get('/checkAccount','CommonController@checkAccount'); #对账接口
            $api->get('/queryStock','CommonController@queryStock'); 	#库存同步接口
            $api->get('/singleStock','CommonController@singleStock'); 	#根据商品销售id获取库存
            $api->get('/getAgents','CommonController@getAgents'); 		#地区接口
			$api->get('/getSmsCode','CommonController@getSmsCode');     #获取短信



            //bannerl图
            $api->get('/banner','BannerController@index'); #获取banner



			//商品
            $api->get('/product/getProductsByAgent','ProductController@getProductsByAgent');  #根据代理商id获取流量包
            $api->get('/product/getProductsByAgentName','ProductController@getProductsByAgentName');  #根据代理商名字获取流量包

			//微信相关
			$api->any('/wxapi/getMenu','WxController@getMenu');  //获取菜单
			$api->any('/wxapi/setMenu','WxController@setMenu');  //设置菜单
			$api->any('/wxapi/getUser','WxController@getUser');  //获取用户
			$api->any('/wxapi/getUserList','WxController@getUserList');  //获取用户列表
			$api->any('/wxapi/setRemark','WxController@setRemark');  //设置用户备注
			$api->any('/wxapi/getUserGroupId','WxController@getUserGroupId');  //获取用户分组id
			$api->any('/wxapi/blacklist','WxController@blacklist');  //获取黑名单
			$api->any('/wxapi/cardColors','WxController@cardColors');  //获取卡券颜色
			$api->any('/wxapi/addCard','WxController@addCard');  //创建卡券
			$api->any('/wxapi/cardQrcode','WxController@cardQrcode');  //创建卡券
			$api->any('/wxapi/cardDelete','WxController@cardDelete');  //删除卡券
			$api->any('/wxapi/cardDisable','WxController@cardDisable');  //卡券失效
			$api->any('/wxapi/cardWhitelist','WxController@cardWhitelist');  //创建卡券测试白名单
			$api->any('/wxapi/cardInfo','WxController@cardInfo');  //查看卡券详情
			$api->any('/wxapi/cardList','WxController@cardList');  //批量查询卡列表
			$api->any('/wxapi/increaseStock','WxController@increaseStock');  //卡券增加库存
			$api->any('/wxapi/reduceStock','WxController@reduceStock');  //卡券减少库存
			$api->any('/wxapi/createLandingPage','WxController@createLandingPage');  //卡券货架
			$api->any('/wxapi/consume','WxController@consume');  //核销Code接口
			$api->any('/wxapi/getUserCards','WxController@getUserCards');  //获取用户已领取卡券接口
			$api->any('/wxapi/decryptCode','WxController@decryptCode');  //获取用户已领取卡券接口
			$api->any('/wxapi/getCategories','WxController@getCategories');  //卡券开放类目查询接口
			$api->any('/wxapi/getHtml','WxController@getHtml');  //图文消息群发卡券

		});
        
    });
});















