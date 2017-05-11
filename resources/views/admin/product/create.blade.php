@extends("layouts.admin")


@section('btitle')
	流量产品列表
@endsection

@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.product.index','产品列表')}} / 添加流量产品
@endsection


@section('title')
	添加流量产品
@endsection



@section('content')
	 @include('custom/_status')
	 {!! Form::open(['route'=>['admin.product.store'],'class'=>'form-horizontal']) !!}	
	 @include('admin/product/_createForm')
	 {!! Form::close() !!}
@endsection


