@extends("layouts.admin")


@section('btitle')
	管理员
@endsection


@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.merchant.index','运营商管理')}} / 编辑运营商
@endsection


@section('title')
	编辑运营商
@endsection

@section('content')
	 @include('custom/_status')
	 {!! Form::model($merchant,['route'=>['admin.merchant.update',$merchant->id],'method'=>'patch','class'=>'form-horizontal']) !!}
	 @include('admin/merchant/_createForm')
	 {!! Form::close() !!}
@endsection

