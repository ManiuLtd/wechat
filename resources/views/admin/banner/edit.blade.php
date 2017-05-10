@extends("layouts.admin")


@section('btitle')
	 banner
@endsection


@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.banner.index','banner')}} / 编辑 banner
@endsection


@section('title')
	编辑 banner
@endsection

@section('content')
	 @include('custom/_status')
	 <form method='post' class='form-horizontal'  action="http://up-z2.qiniu.com" enctype="multipart/form-data">
	 	@include('admin/banner/_createForm')
	 </form>
@endsection

