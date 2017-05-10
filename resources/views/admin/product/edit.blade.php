@extends("layouts.admin")


@section('btitle')
	产品列表
@endsection


@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.product.index','产品列表')}} / 编辑产品
@endsection


@section('title')
	编辑产品列表
@endsection

@section('content')
	 @include('custom/_status')
	 {!! Form::model($product,['route'=>['admin.product.update',$product->id],'method'=>'patch','class'=>'form-horizontal']) !!}
	 @include('admin/product/_createForm')
	 {!! Form::close() !!}
@endsection

