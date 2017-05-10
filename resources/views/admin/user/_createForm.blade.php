
	
    <div class="panel-body">
       @include('errors._error')
        
        <div class="form-group">
            {!! Form::label('name','用户名',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
            	{!! Form::text('name', null ,['class'=>'form-control']) !!}
            </div>
        </div>

       
        <div class="form-group">
            {!! Form::label('email','邮箱',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
            	{!! Form::email('email', null ,['class'=>'form-control']) !!}
            </div>
        </div>


        <div class="form-group">
           
            {!! Form::label('password','密码',['class'=>'col-sm-3 control-label']) !!}
             <div class="col-sm-6">
                {!! Form::password('password' ,['class'=>'form-control']) !!}
            </div>
        </div>

         <div class="form-group">
           
            {!! Form::label('password_confirmation','重复密码',['class'=>'col-sm-3 control-label']) !!}
             <div class="col-sm-6">
                {!! Form::password('password_confirmation' ,['class'=>'form-control']) !!}
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





