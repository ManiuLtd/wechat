<style>
form{
	display:inline-block;
}
</style>
{!! Form::open(['route'=>['admin.status',$admin->id],'method'=>'post']) !!}

	@if($admin->status == '正常')
		<button tyle='submit' class='btn btn-info btn-sm' data-loading-text="Loading...">
			{{$admin->status}}
		</button>

	@else
		<button tyle='submit' class='btn btn-primary btn-sm' data-loading-text="Loading...">
			{{$admin->status}}
		</button>
	@endif
	
{!! Form::close() !!}