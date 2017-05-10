<style>
form{
	display:inline-block;
}
</style>

{!! Form::open(['route'=>['admin.order.status',$order->id],'method'=>'post']) !!}
	<button tyle='submit' class='btn btn-info btn-sm' data-loading-text="Loading...">
		{{$order->status}}
	</button>	
{!! Form::close() !!}