@extends("layouts.admin")


@section('btitle')
	banner
@endsection

@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.banner.index','banner')}} / 添加banner
@endsection


@section('title')
	添加banner
@endsection



@section('content')

	 @include('custom/_status')
	 <!-- {!! Form::open(['route'=>['admin.banner.store'],'class'=>'form-horizontal'],['multiple' => true]) !!}	 -->
	 <form method='post' class='form-horizontal'  action="http://up-z2.qiniu.com" enctype="multipart/form-data">
 		@include('admin/banner/_createForm')
	 </form>
	
	 <!-- {!! Form::close() !!} -->
@endsection


