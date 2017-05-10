        <style type="text/css">
            #merchant_id{
                height:28px !important;
                border:1px solid #e9e9e9;
                width:100px;
                border-radius:0px;
            }
        </style>
	
    <div class="panel-body">
       @include('errors._error')
        <div class="form-group">
            {!! Form::label('merchant_id','所属运营商',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('merchant_id', $pluck ,null); !!}
            </div>
        </div>


         <div class="form-group">
            {!! Form::label('name','代理商名称',['class'=>'col-sm-3 control-label']) !!}
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





