
	
    <div class="panel-body">
       @include('errors._error')
        
        <div class="form-group">

            {!! Form::label('name','名称',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
            	{!! Form::text('x:name', $banner? "$banner->name" : "" ,['class'=>'form-control']) !!}
            </div>
        </div>

        <input name="token" type="hidden" value="{{$upToken}}">
       
        <div class="form-group">
            {!! Form::label('file','图片',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
            	{!! Form::file('file', null ,['class'=>'form-control']) !!}
            </div>
        </div>

        <input type='hidden' name="x:id" value='{{$banner? "$banner->id" : ""}}'>
        <input type='hidden' name="x:oldLink" value='{{$banner? "$banner->link" : ""}}'>

       <div style="text-align:center">
            @if($banner)
                <img src="{{config("qiniu.domain").$banner->link}}" width=100 height=50 >
            @endif
        </div>
    
    </div>
    
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <button class="btn btn-mint" type="submit">保存</button>
                <button class="btn btn-warning" type="reset">重置</button>
            </div>
        </div>
    </div>





