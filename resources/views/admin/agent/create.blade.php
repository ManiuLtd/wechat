@extends("layouts.admin")


@section('btitle')
	运营商列表
@endsection

@section('bread')
	 {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.agent.index','代理商管理')}} / 添加代理商
@endsection


@section('title')
	添加代理商
@endsection



@section('content')

	 @include('custom/_status')
	 {!! Form::open(['route'=>['admin.agent.store'],'class'=>'form-horizontal']) !!}	
	 @include('admin/agent/_createForm')
	 {!! Form::close() !!}
@endsection


