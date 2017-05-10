
	
    <div class="panel-body">
       @include('errors._error')
        <div class="form-group">
            {!! Form::label('name','运营商名称',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
            	{!! Form::text('name', null ,['class'=>'form-control']) !!}
            </div>
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





