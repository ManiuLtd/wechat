@extends("layouts.admin")


@section('btitle')
	产品管理
@endsection

@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.product.index','产品列表')}} / {{link_to_route('good.index','商品列表',['id'=>$id])}} / 添加商品
@endsection


@section('title')
	添加产品
@endsection



@section('content')
	 @include('custom/_status')
	 {!! Form::open(['route'=>['good.store',$id],'class'=>'form-horizontal']) !!}	
	 @include('admin/good/_createForm')

	 {!! Form::hidden('product_id',$id) !!}
	 {!! Form::close() !!}
@endsection


