<style>
form{
	display:inline-block;
}
</style>
{!! Form::open(['route'=>['admin.merchant.destroy',$merchant->id],'method'=>'delete']) !!}
	<button tyle='submit' class='btn btn-danger btn-sm'>
		删除
	</button>

{!! Form::close() !!}
