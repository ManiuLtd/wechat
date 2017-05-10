@extends("layouts.admin")


@section('btitle')
	管理员
@endsection


@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.admin.index','管理员')}} / 编辑管理员
@endsection


@section('title')
	编辑管理员
@endsection

@section('content')
	 @include('custom/_status')
	 {!! Form::model($admin,['route'=>['admin.admin.update',$admin->id],'method'=>'patch','class'=>'form-horizontal']) !!}
	 @include('admin/admin/_createForm')
	 {!! Form::close() !!}
@endsection

