<style>
form{
	display:inline-block;
}
</style>

{!! Form::open(['route'=>['admin.user.status',$user->id],'method'=>'post']) !!}

	@if($user->status == '正常')
		<button tyle='submit' class='btn btn-info btn-sm' data-loading-text="Loading...">
			{{$user->status}}
		</button>

	@else
		<button tyle='submit' class='btn btn-primary btn-sm' data-loading-text="Loading...">
			{{$user->status}}
		</button>
	@endif
	
{!! Form::close() !!}