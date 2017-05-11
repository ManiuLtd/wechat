<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>量炫后台管理系统</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/nifty.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/demo/nifty-demo.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/magic-check/css/magic-check.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/pace/pace.min.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/pace/pace.min.js')}}"></script>

    <script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>

    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <script src="{{asset('js/nifty.min.js')}}"></script>

    <script src="{{asset('js/demo/nifty-demo.min.js')}}"></script>
    {{--<script src="{{asset('plugins/morris-js/morris.min.js')}}"></script>--}}
    <script src="{{asset('plugins/morris-js/raphael-js/raphael.min.js')}}"></script>
    <script src="{{asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    {{--<script src="{{asset('js/demo/dashboard.js')}}"></script>--}}


</head>


<body>
<div id="container" class="effect aside-float aside-bright mainnav-lg">


    <header id="navbar">
        <div id="navbar-container" class="boxed">

            <!--Brand logo & name-->
            <!--================================-->
            <div class="navbar-header">
                <a href="index.html" class="navbar-brand">
                    <img src="{{asset('img/logo.png')}}" alt="Nifty Logo" class="brand-icon">

                    <div class="brand-title">
                        <span class="brand-text">量炫</span>
                    </div>
                </a>
            </div>
            <!--================================-->
            <!--End brand logo & name-->


            <!--Navbar Dropdown-->
            <!--================================-->
            <div class="navbar-content clearfix">
                <ul class="nav navbar-top-links pull-left">

                    <!--Navigation toogle button-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <li class="tgl-menu-btn">
                        <a class="mainnav-toggle" href="#">
                            <i class="demo-pli-view-list"></i>
                        </a>
                    </li>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End Navigation toogle button-->


                    <!--Notification dropdown-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            <i class="demo-pli-bell"></i>
                            <span class="badge badge-header badge-danger"></span>
                        </a>

                        <!--Notification dropdown menu-->
                        <div class="dropdown-menu dropdown-menu-md">
                            <div class="pad-all bord-btm">
                                <p class="text-semibold text-main mar-no">你有9条新消息.</p>
                            </div>
                            <div class="nano scrollable">
                                <div class="nano-content">
                                    <ul class="head-list">

                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <p class="pull-left">Database Repair</p>

                                                    <p class="pull-right">70%</p>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div style="width: 70%;" class="progress-bar">
                                                        <span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <!-- Dropdown list-->
                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <p class="pull-left">Upgrade Progress</p>

                                                    <p class="pull-right">10%</p>
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div style="width: 10%;" class="progress-bar progress-bar-warning">
                                                        <span class="sr-only">10% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <!-- Dropdown list-->
                                        <li>
                                            <a class="media" href="#">
                                                <span class="badge badge-success pull-right">90%</span>

                                                <div class="media-left">
                                                    <i class="demo-pli-data-settings icon-2x"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">HDD is full</div>
                                                    <small class="text-muted">50 minutes ago</small>
                                                </div>
                                            </a>
                                        </li>

                                        <!-- Dropdown list-->
                                        <li>
                                            <a class="media" href="#">
                                                <div class="media-left">
                                                    <i class="demo-pli-file-edit icon-2x"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Write a news article</div>
                                                    <small class="text-muted">Last Update 8 hours ago</small>
                                                </div>
                                            </a>
                                        </li>

                                        <!-- Dropdown list-->
                                        <li>
                                            <a class="media" href="#">
                                                <span class="label label-danger pull-right">New</span>

                                                <div class="media-left">
                                                    <i class="demo-pli-speech-bubble-7 icon-2x"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Comment Sorting</div>
                                                    <small class="text-muted">Last Update 8 hours ago</small>
                                                </div>
                                            </a>
                                        </li>

                                        <!-- Dropdown list-->
                                        <li>
                                            <a class="media" href="#">
                                                <div class="media-left">
                                                    <i class="demo-pli-add-user-plus-star icon-2x"></i>
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">New User Registered</div>
                                                    <small class="text-muted">4 minutes ago</small>
                                                </div>
                                            </a>
                                        </li>

                                        <!-- Dropdown list-->
                                        <li class="bg-gray">
                                            <a class="media" href="#">
                                                <div class="media-left">
                                                    <img class="img-circle img-sm" alt="Profile Picture"
                                                         src="{{asset('img/profile-photos/9.png')}}">
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Lucy sent you a message</div>
                                                    <small class="text-muted">30 minutes ago</small>
                                                </div>
                                            </a>
                                        </li>

                                        <!-- Dropdown list-->
                                        <li class="bg-gray">
                                            <a class="media" href="#">
                                                <div class="media-left">
                                                    <img class="img-circle img-sm" alt="Profile Picture"
                                                         src="{{asset('img/profile-photos/3.png')}}">
                                                </div>
                                                <div class="media-body">
                                                    <div class="text-nowrap">Jackson sent you a message</div>
                                                    <small class="text-muted">40 minutes ago</small>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!--Dropdown footer-->
                            <div class="pad-all bord-top">
                                <a href="#" class="btn-link text-dark box-block">
                                    <i class="fa fa-angle-right fa-lg pull-right"></i>Show All Notifications
                                </a>
                            </div>
                        </div>
                    </li>


                </ul>

            </div>


        </div>
    </header>


    <div class="boxed">


        <div id="content-container">


            <div id="page-title">
                <h1 class="page-header text-overflow"> @yield('btitle') </h1>
            </div>

            <p class='mybread'> @yield('bread')</p>

            <div id="page-content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"> @yield('title')</h3>
                            </div>

                            @yield('content')

                            @yield('myJs')
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <nav id="mainnav-container">
            <div id="mainnav">


                <div id="mainnav-menu-wrap">
                    <div class="nano">
                        <div class="nano-content">

                            <!--Profile Widget-->
                            <!--================================-->
                            <div id="mainnav-profile" class="mainnav-profile">
                                <div class="profile-wrap">
                                    <div class="pad-btm">
                                       
                                        <img class="img-circle img-sm img-border"
                                             src="{{asset('img/profile-photos/1.png')}}" alt="Profile Picture">
                                    </div>
                                    <a href="#profile-nav" class="box-block" data-toggle="collapse"
                                       aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>

                                        <p class="mnp-name">{{session('admin.name')}}</p>
                                        <span class="mnp-desc">{{session('admin.email')}}</span>
                                    </a>
                                </div>
                                <div id="profile-nav" class="collapse list-group bg-trans">
                                    <a href="#" class="list-group-item">
                                        <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="demo-pli-gear icon-lg icon-fw"></i> Settings
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="demo-pli-information icon-lg icon-fw"></i> Help
                                    </a>
                                    <a href="/admin/login/logout" class="list-group-item">
                                        <i class="demo-pli-unlock icon-lg icon-fw"></i> 退出
                                    </a>
                                </div>
                            </div>


                            <!--Shortcut buttons-->
                            <!--================================-->
                            <div id="mainnav-shortcut">
                                <ul class="list-unstyled">
                                    <li class="col-xs-3" data-content="My Profile">
                                        <a class="shortcut-grid" href="#">
                                            <i class="demo-psi-male"></i>
                                        </a>
                                    </li>
                                    <li class="col-xs-3" data-content="Messages">
                                        <a class="shortcut-grid" href="#">
                                            <i class="demo-psi-speech-bubble-3"></i>
                                        </a>
                                    </li>
                                    <li class="col-xs-3" data-content="Activity">
                                        <a class="shortcut-grid" href="#">
                                            <i class="demo-psi-thunder"></i>
                                        </a>
                                    </li>
                                    <li class="col-xs-3" data-content="Lock Screen">
                                        <a class="shortcut-grid" href="#">
                                            <i class="demo-psi-lock-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!--================================-->
                            <!--End shortcut buttons-->


                            <ul id="mainnav-menu" class="list-group">

                                <!--Category name-->
                                <li class="list-header">Navigation</li>

                                <!--Menu list item-->
                                <li class="active-link">
                                    <a href="index.html">
                                        <i class="demo-psi-home"></i>
						                    <span class="menu-title">
												<strong>Dashboard</strong>
											</span>
                                    </a>
                                </li>

                                <!--Menu list item-->
                                <li>
                                    <a href="#">
                                        <i class="demo-psi-split-vertical-2"></i>
						                    <span class="menu-title">
												<strong>管理员管理</strong>
											</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse @if(in_array(Route::currentRouteName(),['admin.admin.index','admin.admin.create','admin.admin.edit']))  in   @endif">
                                        <li>{{ link_to_route('admin.admin.index','管理员列表')}}</li>
                                    </ul>
                                </li>


                                <li>
                                    <a href="#">
                                        <i class="demo-psi-repair"></i>
                                        <span class="menu-title">企业用户管理</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse @if(in_array(Route::currentRouteName(),['admin.user.index','admin.user.create','admin.user.edit']))  in   @endif">
                                        <li>{{ link_to_route('admin.user.index','用户管理')}}</li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="demo-psi-repair"></i>
                                        <span class="menu-title">广告管理</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse @if(in_array(Route::currentRouteName(),['admin.banner.index','admin.banner.create','admin.banner.edit']))  in   @endif">
                                        <li>{{ link_to_route('admin.banner.index','广告列表')}}</li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="demo-psi-repair"></i>
                                        <span class="menu-title">运营商</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse @if(in_array(Route::currentRouteName(),['admin.merchant.index','admin.merchant.create','admin.merchant.edit']))  in   @endif">
                                        <li>{{ link_to_route('admin.merchant.index','运营商列表')}}</li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="demo-psi-repair"></i>
                                        <span class="menu-title">省级运营商管理</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse @if(in_array(Route::currentRouteName(),['admin.merchant.index','admin.merchant.create','admin.merchant.edit']))  in   @endif">
                                        <li>{{ link_to_route('admin.agent.index','省级运营商列表')}}</li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="demo-psi-repair"></i>
                                        <span class="menu-title">流量产品管理</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse @if(in_array(Route::currentRouteName(),['admin.product.index','admin.product.create','admin.product.edit']))  in   @endif">
                                        <li>{{ link_to_route('admin.product.index','流量产品列表')}}</li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="demo-psi-repair"></i>
                                        <span class="menu-title">报表管理</span>
                                        <i class="arrow"></i>
                                    </a>

                                    <!--Submenu-->
                                    <ul class="collapse @if(in_array(Route::currentRouteName(),['order.report']))  in   @endif">
                                        <li>{{ link_to_route('order.report','下家订购')}}</li>
                                    </ul>

                                   
                                </li>


                        </div>
                    </div>
                </div>


            </div>
        </nav>


    </div>

    <footer id="footer">

        <div class="show-fixed pull-right">
            You have <a href="#" class="text-bold text-main"><span class="label label-danger">3</span> pending
                action.</a>
        </div>


        <p class="pad-lft">&#0169; 2017 Your Company</p>


    </footer>

    <button class="scroll-top btn">
        <i class="pci-chevron chevron-up"></i>
    </button>
</div>


</body>
</html>
