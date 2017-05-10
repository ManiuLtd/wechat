<?php


Route::get('/swagger/doc', 'SwaggerController@doc');


Route::group(['namespace'=>'Pchome'],function(){
	Route::get('/', [
    		'as' => 'pchome.index','uses' =>'IndexController@index'
	]);
});

//wechat测试
Route::any('/wechat','WechatController@index');


Route::get('/demo','DemoController@index');

Route::get('/admin','Admin\AdminController@index');

Route::any('/bannerCallback','Admin\BannerController@bannerCallback');


Route::group(['namespace'=>'Admin','middleware'=>'admin','prefix'=>'admin'],function(){

	### Excel ###
	Route::get('detail/export/{id}',[
	'as' => 'admin.details.export', 'uses' => 'DetailController@export'
	]);

	###  报表 ###
	Route::get('report',[
		'as' => 'order.report', 'uses' => 'ReportController@index'
	]);
	### 运营商 ###
	Route::get('merchant/{id}/agents',[
		'as' => 'admin.merchant.agents','uses' =>'MerchantController@agents'
	]);

	### 根据merchant_id 获取agents
	Route::post('merchant/ajax_agents',[
		'as' => 'admin.merchant.ajax_agents','uses' =>'MerchantController@ajax_agents'
	]);

	### 根据agent_id 获取 products
	Route::post('agent/ajax_products',[
		'as' => 'admin.agent.ajax_products','uses' =>'AgentController@ajax_products'
	]);

	Route::resource("merchant","MerchantController");

	### 代理商 ###
	Route::resource("agent","AgentController");
	Route::get('agent/{id}/products',[
		'as' => 'admin.agent.goods', 'uses' => 'AgentController@goods'
	]);


	### 用户订单汇总 ###
	Route::get("user/{id}/order",[
		'as' => 'admin.user.order','uses' => 'OrderController@index'
	]);

	Route::get('users/{id}/porder',[
		'as' => 'admin.user.porder','uses' => 'PersonorderController@index'
	]);

	Route::get('user/{user_id}/order/{order_id}',[
		'as' => 'admin.user.order.details','uses' => 'OrderController@show'
	]);

	Route::post('order/{id}/status',[
	    'as' => 'admin.order.status', 'uses' => 'OrderController@status'
	]);


	### 用户库存 ###
	Route::get("user/{id}/stock",[
		'as' => 'admin.user.stock','uses' => 'OrderController@stock'
	]);

	Route::get('/details/{id}',[
		'as' => 'admin.detail.useds','uses'=>'DetailController@index' 
	]);

	### 后台为用户创建订单
	Route::get('user/{id}/buy',[
		'as' => 'admin.user.buy', 'uses' => 'OrderController@create'
	]);

	Route::post('order',[
		'as' => 'admin.user.order.store','uses' => 'OrderController@store'
	]);


	Route::get('/admin','AdminController@index');

	###  企业用户 ###
	Route::resource('user','UserController');

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

	### admin ###
	Route::resource('admin','AdminController');

	### banner ###
	Route::resource('banner','BannerController');


	### product ###
	Route::resource('product','ProductController');

	### 管理员状态 ###
	Route::post('admin/{id}/status',[
	    'as' => 'admin.status', 'uses' => 'AdminController@status'
	]);

	### 企业状态 ###
	Route::post('admin/user/{id}/status',[
	    'as' => 'admin.user.status', 'uses' => 'UserController@status'
	]);

	### 管理员退出 ###
	Route::get('login/logout',[
		'as' => 'login.logout', 'uses' => 'LoginController@logout'
	]);
});


Route::get('/login',[
	'as' => 'login.login', 'uses' => 'Admin\LoginController@login'
]);

Route::post('/doLogin','Admin\LoginController@doLogin');


Route::any('oauth','WxController@oauth');


### api
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api'], function ($api) {
        $api->group(['middleware'=>['api.cors']], function ($api) {
            $api->get('/getToken','UserController@getToken');     
            $api->get('/checkToken','UserController@checkToken');
            $api->get('/buy','UserController@checkToken'); #购买流量
            $api->post('/batchBuy','UserController@batchBuy'); #企业批量购买流量
            $api->get('/orders','UserController@orders'); #企业订单订购记录
            $api->get('/stocks','UserController@stocks'); #企业订单订购记录
            $api->get('/register','UserController@register'); #企业用户注册
            $api->get('/login','UserController@login'); #企业用户登录

            //企业调用接口
            $api->post('/orderBuy','ForeignController@orderBuy'); #使用流量
            $api->get('/qOrder','ForeignController@queryOrder'); #使用流量

            //流量平台给的接口 公共接口
            $api->get('/lxStock','CommonController@lxStock'); #lx库存
            $api->post('/lxBuy','CommonController@lxBuy'); #购买流量
            $api->get('/queryOrder','CommonController@queryOrder'); #订购查询
            $api->get('/checkAccount','CommonController@checkAccount'); #对账接口
            $api->get('/queryStock','CommonController@queryStock'); #库存同步接口
            $api->get('/singleStock','CommonController@singleStock'); #根据商品销售id获取库存
            $api->get('/getAgents','CommonController@getAgents'); #地区接口

            //banner
            $api->get('/banner','BannerController@index');


            //获取短信
            $api->get('/getSmsCode','CommonController@getSmsCode');  

            $api->any('/wxapi/index','WxController@index');  
            $api->any('/wxapi/auth','WxController@auth');  
            $api->any('/wxapi/menu','WxController@menu');  
            $api->get('/product/getProductsByAgent','ProductController@getProductsByAgent');  #根据代理商id获取流量包
            $api->get('/product/getProductsByAgentName','ProductController@getProductsByAgentName');  #根据代理商名字获取流量包
            $api->post('/buy','UserController@buy');   
            $api->get('/personorders','UserController@personorders');   
        });
        
    });
});















