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

			//微信用户相关
			$api->any('/wxUserApi/getUser','WxUserApiController@getUser');  //根据openid获取用户
			$api->any('/wxUserApi/getUserList','WxUserApiController@getUserList');  //获取用户列表
			$api->any('/wxUserApi/setRemark','WxUserApiController@setRemark');  //设置用户备注
			$api->any('/wxUserApi/getUserGroupId','WxUserApiController@getUserGroupId');  //获取用户分组id
			$api->any('/wxUserApi/blacklist','WxUserApiController@blacklist');  //获取黑名单
			$api->any('/wxUserApi/lists','WxUserApiController@lists');  //获取所有分组
			$api->any('/wxUserApi/create','WxUserApiController@create');  //创建分组
			$api->any('/wxUserApi/update','WxUserApiController@update');  //创建分组
			$api->any('/wxUserApi/delete','WxUserApiController@delete');  //删除分组
			$api->any('/wxUserApi/moveUser','WxUserApiController@moveUser');  //移动单个用户到指定分组
			$api->any('/wxUserApi/moveUsers','WxUserApiController@moveUsers');  //批量移动用户到指定分组

			//素材
			$api->any('/WxMediaApi/uploadImage','WxMediaApiController@uploadImage');  //上传图片
			$api->any('/WxMediaApi/uploadImageTmp','WxMediaApiController@uploadImageTmp');  //上传图片Tmp
			$api->any('/WxMediaApi/uploadVoice','WxMediaApiController@uploadVoice');  //上传音频
			$api->any('/WxMediaApi/uploadVoiceTmp','WxMediaApiController@uploadVoiceTmp');  //上传音频 Tmp
			$api->any('/WxMediaApi/uploadVideo','WxMediaApiController@uploadVideo');  //上传音频
			$api->any('/WxMediaApi/uploadVideoTmp','WxMediaApiController@uploadVideoTmp');  //上传音频Tmp
			$api->any('/WxMediaApi/uploadThumb','WxMediaApiController@uploadThumb');  //上传缩略图
			$api->any('/WxMediaApi/uploadThumbTmp','WxMediaApiController@uploadThumbTmp');  //上传缩略图Tmp
			$api->any('/WxMediaApi/uploadArticle','WxMediaApiController@uploadArticle');  //上传永久图文
			$api->any('/WxMediaApi/get','WxMediaApiController@get');  //获取永久素材
			$api->any('/WxMediaApi/lists','WxMediaApiController@lists');  //获取永久素材列表
			$api->any('/WxMediaApi/stats','WxMediaApiController@stats');  //获取素材计数
			$api->any('/WxMediaApi/delete','WxMediaApiController@delete');  //删除永久素材；
			$api->any('/WxMediaApi/getStream','WxMediaApiController@getStream');  //获取临时素材内容；
			$api->any('/WxMediaApi/download','WxMediaApiController@download');  //下载临时素材到本地


			//用户标签
			$api->any('/WxTagApi/lists','WxTagApiController@lists');  //获取所有标签
			$api->any('/WxTagApi/create','WxTagApiController@create');  //创建标签
			$api->any('/WxTagApi/update','WxTagApiController@update');  //编辑标签
			$api->any('/WxTagApi/delete','WxTagApiController@delete');  //delete
			$api->any('/WxTagApi/userTags','WxTagApiController@userTags');  //获取指定 openid 用户身上的标签
			$api->any('/WxTagApi/usersOfTag','WxTagApiController@usersOfTag');  //获取标签下粉丝列表
			$api->any('/WxTagApi/batchTagUsers','WxTagApiController@batchTagUsers');  //批量为用户打标签
			$api->any('/WxTagApi/batchUntagUsers','WxTagApiController@batchUntagUsers');  //批量为用户取消标签

			//模板消息
			$api->any('/WxNoticeApi/getIndustry','WxNoticeApiController@getIndustry');  //返回所有支持的行业列表
			$api->any('/WxNoticeApi/setIndustry','WxNoticeApiController@setIndustry');  //修改账号所属行业
			$api->any('/WxNoticeApi/addTemplate','WxNoticeApiController@addTemplate');  //添加模板并获取模板ID
			$api->any('/WxNoticeApi/send','WxNoticeApiController@send');  //发送模板消息, 返回消息ID；
			$api->any('/WxNoticeApi/getPrivateTemplates','WxNoticeApiController@getPrivateTemplates');  //getPrivateTemplates() 获取所有模板列表
			$api->any('/WxNoticeApi/deletePrivateTemplate','WxNoticeApiController@deletePrivateTemplate');  //deletePrivateTemplate($templateId)

			//二维码

			$api->any('/WxQrcodeApi/temporary','WxQrcodeApiController@temporary');  //创建临时二维码
			$api->any('/WxQrcodeApi/forever','WxQrcodeApiController@forever');  //创建永久二维码
			$api->any('/WxQrcodeApi/url','WxQrcodeApiController@url');  //获取二维码网址
			$api->any('/WxQrcodeApi/content','WxQrcodeApiController@content');  //获取二维码内容



		});
        
    });
});















