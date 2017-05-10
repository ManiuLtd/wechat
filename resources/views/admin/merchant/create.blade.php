@extends("layouts.admin")


@section('btitle')
	运营商列表
@endsection

@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.merchant.index','运营商管理')}} / 添加运营商
@endsection


@section('title')
	添加运营商
@endsection



@section('content')

	 @include('custom/_status')
	 {!! Form::open(['route'=>['admin.merchant.store'],'class'=>'form-horizontal']) !!}	
	 @include('admin/merchant/_createForm')
	 {!! Form::close() !!}
@endsection


