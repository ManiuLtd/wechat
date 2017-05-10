<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="{{asset('pchome/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{asset('pchome/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="{{asset('pchome/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="{{asset('pchome/js/jquery-1.11.1.min.js')}}"></script>
<!-- //js -->

<script type="text/javascript" src="{{asset('pchome/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('pchome/js/easing.js')}}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
	
<body>
<!-- header -->
	<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
				<p>量炫流量分销平台</p>
			</div>
			<div class="agile-login">
				<ul>
					<li><a href="registered.html">注册</a></li>
					<li><a href="login.html">登录</a></li>
					<li><a href="contact.html">帮助</a></li>
					
				</ul>
			</div>
			<div class="product_list_header">  
					<form action="#" method="post" class="last"> 
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="display" value="1">
						<button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
					</form>  
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

	<div class="logo_products">
		<div class="container">
		<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>客服经理热线：010-123456789</li>
					
				</ul>
			</div>
			<div class="w3ls_logo_products_left">
				<h1><a href="index.html">量炫流量分销平台</a></h1>
			</div>
		<div class="w3l_search">
			<form action="#" method="post">
				<input type="search" name="Search" placeholder="产品搜索" required="">
				<button type="submit" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i>
				</button>
				<div class="clearfix"></div>
			</form>
		</div>
			
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- navigation -->
	<div class="navigation-agileits">
		<div class="container">
			<nav class="navbar navbar-default">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header nav_2">
								<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div> 
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav">
									<li class="active"><a href="index.html" class="act">首页</a></li>	
									<!-- Mega Menu -->
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">中国电信<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>流量可以区</h6>
														<li><a href="groceries.html">江苏电信</a></li>
														<li><a href="groceries.html">广东电信</a></li>
														<li><a href="groceries.html">上海电信</a></li>
													</ul>
												</div>	
												
											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">中国移动<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>流量可以区</h6>
														<li><a href="household.html">江苏移动</a></li>
														<li><a href="household.html">广东移动</a></li>
														<li><a href="household.html">上海移动</a></li>
													</ul>
												</div>
												
												
											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">中国联通<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>流量可以区</h6>
														<li><a href="personalcare.html">江苏联通</a></li>
														<li><a href="personalcare.html">广东联通</a></li>
														<li><a href="personalcare.html">上海联通</a></li>
													</ul>
												</div>
												
											</div>
										</ul>
									</li>
									
								</ul>
							</div>
							</nav>
			</div>
		</div>
		
		<!-- Banner图 -->
		<ul id="demo1">
			<li>
				<img src="{{asset('pchome/images/11.jpg')}}" alt="" />
				<!--Slider Description example-->
				<div class="slide-desc">
					<h3>Buy Rice Products Are Now On Line With Us</h3>
				</div>
			</li>
			<li>
				<img src="{{asset('pchome/images/22.jpg')}}" alt="" />
				  <div class="slide-desc">
					<h3>Whole Spices Products Are Now On Line With Us</h3>
				</div>
			</li>
			
			<li>
				<img src="{{asset('pchome/images/44.jpg')}}" alt="" />
				<div class="slide-desc">
					<h3>Whole Spices Products Are Now On Line With Us</h3>
				</div>
			</li>
		</ul>
	
	<div class="top-brands">
		<div class="container">
		<h2>中国电信</h2>
			<div class="grid_3 grid_5">
				<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#expeditions" id="expeditions-tab" role="tab" data-toggle="tab" aria-controls="expeditions" aria-expanded="true">江苏电信</a></li>
						
					</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="expeditions" aria-labelledby="expeditions-tab">
							<div class="agile-tp">
								<h5>江苏电信流量包</h5>
								<p class="w3l-ad">分国内流量包和省内流量包</p>
							</div>

							<!-- one cloumn -->
							<div class="agile_top_brands_grids">
							
								@foreach($products as $product)
									<div class="col-md-4 top_brand_left">
										<div class="hover14 column">
											<div class="agile_top_brand_left_grid">
												<div class="agile_top_brand_left_grid_pos">
													<img src="{{asset('pchome/images/offer.png')}}" alt=" " class="img-responsive" />
												</div>
												<div class="agile_top_brand_left_grid1">
													<figure>
														<div class="snipcart-item block" >
															<div class="snipcart-thumb">
																<a href="products.html"><img title=" " alt=" " src="{{asset('pchome/images/30.jpeg')}}" /></a>		
																<p>{{$product->name}}</p>
															<!-- 	<div class="stars">
																	<i class="fa fa-star blue-star" aria-hidden="true"></i>
																	<i class="fa fa-star blue-star" aria-hidden="true"></i>
																	<i class="fa fa-star blue-star" aria-hidden="true"></i>
																	<i class="fa fa-star blue-star" aria-hidden="true"></i>
																	<i class="fa fa-star gray-star" aria-hidden="true"></i>
																</div> -->
																<h4>￥{{$product->goods()->where(['saleType'=>0,'agent_id'=>1])->first()->money}}</h4>
															</div>
															<div class="snipcart-details top_brand_home_details">
																<form action="#" method="post">
																	<fieldset>
																		<input type="hidden" name="cmd" value="_cart" />
																		<input type="hidden" name="add" value="1" />
																		<input type="hidden" name="business" value=" " />
																		<input type="hidden" name="item_name" value="Fortune Sunflower Oil" />
																		<input type="hidden" name="amount" value="20.99" />
																		<input type="hidden" name="discount_amount" value="1.00" />
																		<input type="hidden" name="currency_code" value="USD" />
																		<input type="hidden" name="return" value=" " />
																		<input type="hidden" name="cancel_return" value=" " />
																		<input type="submit" name="submit" value="加入购物车" class="button" />
																	</fieldset>
																</form>
															</div>
														</div>
													</figure>
												</div>
											</div>
										</div>
									</div>
								@endforeach



								<div class="clearfix"> </div>
							</div>
							
							



							<div class="agile_top_brands_grids">
								<div class="col-md-4 top_brand_left">
									<div class="hover14 column">
										<div class="agile_top_brand_left_grid">
											<div class="agile_top_brand_left_grid_pos">
												<img src="{{asset('pchome/images/offer.png')}}" alt=" " class="img-responsive" />
											</div>
											<div class="agile_top_brand_left_grid1">
												<figure>
													<div class="snipcart-item block" >
														<div class="snipcart-thumb">
															<a href="products.html"><img title=" " alt=" " src="{{asset('pchome/images/30.jpeg')}}" /></a>		
															<p>30M</p>
															<div class="stars">
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star gray-star" aria-hidden="true"></i>
															</div>
															<h4>￥20.99</h4>
														</div>
														<div class="snipcart-details top_brand_home_details">
															<form action="#" method="post">
																<fieldset>
																	<input type="hidden" name="cmd" value="_cart" />
																	<input type="hidden" name="add" value="1" />
																	<input type="hidden" name="business" value=" " />
																	<input type="hidden" name="item_name" value="Fortune Sunflower Oil" />
																	<input type="hidden" name="amount" value="20.99" />
																	<input type="hidden" name="discount_amount" value="1.00" />
																	<input type="hidden" name="currency_code" value="USD" />
																	<input type="hidden" name="return" value=" " />
																	<input type="hidden" name="cancel_return" value=" " />
																	<input type="submit" name="submit" value="加入购物车" class="button" />
																</fieldset>
															</form>
														</div>
													</div>
												</figure>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4 top_brand_left">
									<div class="hover14 column">
										<div class="agile_top_brand_left_grid">
											<div class="agile_top_brand_left_grid_pos">
												<img src="{{asset('pchome/images/offer.png')}}" alt=" " class="img-responsive" />
											</div>
											<div class="agile_top_brand_left_grid1">
												<figure>
													<div class="snipcart-item block" >
														<div class="snipcart-thumb">
															<a href="products.html"><img title=" " alt=" " src="{{asset('pchome/images/30.jpeg')}}" /></a>		
															<p>30M</p>
															<div class="stars">
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star gray-star" aria-hidden="true"></i>
															</div>
															<h4>￥20.99</h4>
														</div>
														<div class="snipcart-details top_brand_home_details">
															<form action="#" method="post">
																<fieldset>
																	<input type="hidden" name="cmd" value="_cart" />
																	<input type="hidden" name="add" value="1" />
																	<input type="hidden" name="business" value=" " />
																	<input type="hidden" name="item_name" value="Fortune Sunflower Oil" />
																	<input type="hidden" name="amount" value="20.99" />
																	<input type="hidden" name="discount_amount" value="1.00" />
																	<input type="hidden" name="currency_code" value="USD" />
																	<input type="hidden" name="return" value=" " />
																	<input type="hidden" name="cancel_return" value=" " />
																	<input type="submit" name="submit" value="加入购物车" class="button" />
																</fieldset>
															</form>
														</div>
													</div>
												</figure>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4 top_brand_left">
									<div class="hover14 column">
										<div class="agile_top_brand_left_grid">
											<div class="agile_top_brand_left_grid_pos">
												<img src="{{asset('pchome/images/offer.png')}}" alt=" " class="img-responsive" />
											</div>
											<div class="agile_top_brand_left_grid1">
												<figure>
													<div class="snipcart-item block" >
														<div class="snipcart-thumb">
															<a href="products.html"><img title=" " alt=" " src="{{asset('pchome/images/30.jpeg')}}" /></a>		
															<p>30M</p>
															<div class="stars">
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star blue-star" aria-hidden="true"></i>
																<i class="fa fa-star gray-star" aria-hidden="true"></i>
															</div>
															<h4>￥20.99</h4>
														</div>
														<div class="snipcart-details top_brand_home_details">
															<form action="#" method="post">
																<fieldset>
																	<input type="hidden" name="cmd" value="_cart" />
																	<input type="hidden" name="add" value="1" />
																	<input type="hidden" name="business" value=" " />
																	<input type="hidden" name="item_name" value="Fortune Sunflower Oil" />
																	<input type="hidden" name="amount" value="20.99" />
																	<input type="hidden" name="discount_amount" value="1.00" />
																	<input type="hidden" name="currency_code" value="USD" />
																	<input type="hidden" name="return" value=" " />
																	<input type="hidden" name="cancel_return" value=" " />
																	<input type="submit" name="submit" value="加入购物车" class="button" />
																</fieldset>
															</form>
														</div>
													</div>
												</figure>
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix"> </div>
							</div>

						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- //top-brands -->
 <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        
        <div class="item">
         <a href="personalcare.html"> <img class="second-slide " src="images/b3.jpg" alt="Second slide"></a>
         
        </div>
        <div class="item">
          <a href="household.html"><img class="third-slide " src="images/b1.jpg" alt="Third slide"></a>
          
        </div>
      </div>
    
    </div><!-- /.carousel -->	

	<div class="newproducts-w3agile">
		<div class="container">
			<h3>流量类型</h3>
				<div class="agile_top_brands_grids">
					<div class="col-md-3 top_brand_left-1">
						<div class="hover14 column">
							<div class="agile_top_brand_left_grid">
								<div class="agile_top_brand_left_grid_pos">
										<img src="{{asset('pchome/images/offer.png')}}" alt=" " class="img-responsive" />
								</div>
								<div class="agile_top_brand_left_grid1">
									<figure>
										<div class="snipcart-item block">
											<div class="snipcart-thumb">
												<a href="products.html"><img title=" " alt=" " src="{{asset('pchome/images/14.png')}}"></a>		
												<p>江苏电信国内通用流量包</p>
												<div class="stars">
													<i class="fa fa-star blue-star" aria-hidden="true"></i>
													<i class="fa fa-star blue-star" aria-hidden="true"></i>
													<i class="fa fa-star blue-star" aria-hidden="true"></i>
													<i class="fa fa-star blue-star" aria-hidden="true"></i>
													<i class="fa fa-star gray-star" aria-hidden="true"></i>
												</div>
													<h4>$35.99 <span>$55.00</span></h4>
											</div>
											<div class="snipcart-details top_brand_home_details">
												<form action="#" method="post">
													<fieldset>
														<input type="hidden" name="cmd" value="_cart">
														<input type="hidden" name="add" value="1">
														<input type="hidden" name="business" value=" ">
														<input type="hidden" name="item_name" value="Fortune Sunflower Oil">
														<input type="hidden" name="amount" value="35.99">
														<input type="hidden" name="discount_amount" value="1.00">
														<input type="hidden" name="currency_code" value="USD">
														<input type="hidden" name="return" value=" ">
														<input type="hidden" name="cancel_return" value=" ">
														<input type="submit" name="submit" value="Add to cart" class="button">
													</fieldset>
												</form>
											</div>
										</div>
									</figure>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="clearfix"> </div>
				</div>

		</div>
	</div>
<!-- //new -->
<!-- //footer -->
<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
				<div class="col-md-3 w3_footer_grid">
					<h3>联系我们</h3>
					
					<ul class="address">
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>上海市南汇工业园区沪南公路 <span>中国上海.</span></li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">muji@muji.com</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 567</li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>关于我们</h3>
					<ul class="info"> 
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="about.html">关于我们</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="faq.html">问题</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="products.html">产品理念</a></li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>产品分类</h3>
					<ul class="info"> 
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="groceries.html">中国电信</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="household.html">中国移动</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="personalcare.html">中国联通</a></li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>个人中心</h3>
					<ul class="info"> 
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="checkout.html">我的购物车</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="login.html">登录</a></li>
						<li><i class="fa fa-arrow-right" aria-hidden="true"></i><a href="registered.html">注册</a></li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		
		<div class="footer-copy">
			
			<div class="container">
				<p>Copyright &copy; 2017.Company name All rights reserved.</p>
			</div>
		</div>
		
	</div>	

<!-- //footer -->	
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('pchome/js/bootstrap.min.js')}}"></script>

<!-- top-header and slider -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="{{asset('pchome/js/minicart.min.js')}}"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>
<!-- main slider-banner -->
<script src="{{asset('pchome/js/skdslider.min.js')}}"></script>
<link href="{{asset('pchome/css/skdslider.css')}}" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
						
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});
			
		});
</script>	
<!-- //main slider-banner --> 
</body>
</html>