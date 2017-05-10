<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>量炫流量后台管理系统</title>


  <!--   <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'> -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/nifty.min.css" rel="stylesheet">


    <link href="css/demo/nifty-demo-icons.min.css" rel="stylesheet">

    <link href="css/demo/nifty-demo.min.css" rel="stylesheet">

 <!--   <script src="js/jquery-2.2.4.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/nifty.min.js"></script>

    <script src="js/demo/bg-images.js"></script>
        
  -->
</head>

<body>
	<div id="container" class="cls-container" style='background-image: url("img/bg-img/bg-img-5.jpg")'>
		
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay"></div>
		
		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h3 class="h3 mar-no">量炫流量后台管理系统</h3>
		                <p class="text-muted">创新 努力 创造未来</p>
		            </div>

		           @if (session('status'))
					    <div class="alert alert-warning" id='msg'>
					       {{session('status')}}
					    </div>

					
					@endif

		            <form action="/doLogin" method="post">
		            	{{csrf_field()}}
		                <div class="form-group">
		                    <input type="text" class="form-control" placeholder="用户名" value="{{ old('name') }}" name='name' autofocus required>
		                </div>
		                <div class="form-group">
		                    <input type="password" name='password' class="form-control" value="{{ old('password') }}" placeholder="密码" required>
		                </div>
		                <div class="checkbox pad-btm text-left">
		                    
		                </div>
		                <button class="btn btn-primary btn-lg btn-block" type="submit">登录</button>
		            </form>
		        </div>
		    </div>
		</div>
		<!--===================================================-->
		
		
		<!-- DEMO PURPOSE ONLY -->
		<!--===================================================-->
	<!-- 	<div class="demo-bg">
		    <div id="demo-bg-list">
		        <div class="demo-loading"><i class="psi-repeat-2"></i></div>
		        <img class="demo-chg-bg bg-trans active" src="img/bg-img/thumbs/bg-trns.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-1.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-2.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-3.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-4.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-5.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-6.jpg" alt="Background Image">
		        <img class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-7.jpg" alt="Background Image">
		    </div>
		</div> -->

		
	</div>



		</body>
</html>
