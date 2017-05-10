@extends("layouts.admin")


@section('btitle')
	产品管理
@endsection


@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.product.index','产品列表')}} / {{link_to_route('good.index','商品列表',['id'=>$product_id])}} / 编辑商品
@endsection

@section('title')
	编辑商品
@endsection

@section('content')
	 @include('custom/_status')
	 {!! Form::model($good,['route'=>['good.update',$good->id],'method'=>'patch','class'=>'form-horizontal']) !!}
	 @include('admin/good/_createForm')
	 {!! Form::close() !!}

	 <script>
	 	 $("#saleType").val("{{ $saleType }}");
	 	 $("#product_id").val("{{ $product_id }}");
	 </script>
@endsection

