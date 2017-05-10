@extends("layouts.admin")


@section('btitle')
	代理商管理
@endsection


@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.agent.index','代理商管理')}} / 编辑代理商
@endsection


@section('title')
	编辑代理商
@endsection

@section('content')
	 @include('custom/_status')
	 {!! Form::model($agent,['route'=>['admin.agent.update',$agent->id],'method'=>'patch','class'=>'form-horizontal']) !!}
	 @include('admin/agent/_createForm')
	 {!! Form::close() !!}
@endsection

