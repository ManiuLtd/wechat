<style>
form{
	display:inline-block;
}
</style>
{!! Form::open(['route'=>['admin.banner.destroy',$banner->id],'method'=>'delete']) !!}
	<button tyle='submit' class='btn btn-danger btn-sm'>
		删除
	</button>
{!! Form::close() !!}
