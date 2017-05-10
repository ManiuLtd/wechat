@extends("layouts.admin")


@section('btitle')
	用户管理
@endsection

@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.user.index','用户管理')}} / {{link_to_route('admin.user.index','用户列表')}} / 创建订单
@endsection


@section('title')
	创建订单
@endsection

@section('content')

    <link href="{{asset('admin/css/order_create.css')}}" rel="stylesheet">

    <div id="page-content">
         @include('custom/_status')
         @include('admin/order/_createForm')
    </div>


@endsection


@section('myJs')
    <script src="{{asset('admin/js/create_order.js')}}"></script>
@endsection


	



