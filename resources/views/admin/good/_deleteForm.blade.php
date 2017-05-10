<style>
form{
	display:inline-block;
}
</style>
{!! Form::open(['route'=>['product.destroy',$product->id],'method'=>'delete']) !!}
	<button tyle='submit' class='btn btn-danger btn-sm'>
		删除
	</button>
{!! Form::close() !!}
