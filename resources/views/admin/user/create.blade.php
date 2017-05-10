@extends("layouts.admin")


@section('btitle')
	管理员
@endsection

@section('bread')
	{{link_to_route('admin.index','首页')}} / {{link_to_route('admin.index','管理员')}} / 添加管理员
@endsection


@section('title')
	添加管理员
@endsection



@section('content')

	 @include('custom/_status')
	 {!! Form::open(['route'=>['admin.store'],'class'=>'form-horizontal']) !!}	
	 @include('admin/_createForm')
	 {!! Form::close() !!}
@endsection


