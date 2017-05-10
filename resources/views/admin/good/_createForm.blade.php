
	
    <div class="panel-body">
        <style type="text/css">
            select{
                height:28px !important;
                border:1px solid #e9e9e9;
                width:120px;
                border-radius:0px;
            }
        </style>

       @include('errors._error')

        <div class="form-group">
            {!! Form::label('merchant_id','所属运营商',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('merchant_id',$pluck,$merchant_id); !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('agent_id','所属代理商',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('agent_id',['0'=>'请选择代理商'],null); !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('saleType','类型',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('saleType', [0 => '省内流量包', 1 => '国内流量包'],null); !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('product_id','产品分类',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('product_id',$product_pluck,$id); !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('productName','商品名称',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
            	{!! Form::text('productName', null ,['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('productType','商品类型',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('productType', null ,['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('saleId','商品销售id',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('saleId', null ,['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('oldMoney','原价',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('oldMoney', null ,['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('money','价格',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('money', null ,['class'=>'form-control']) !!}
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

    <script>
        $("#merchant_id").change(function(){
            var val = $(this).val()
            var urls="/admin/merchant/ajax_agents";
            var agent_id = "{{$agent_id}}"
            var con = '';
            $.ajax({
                dataType:"json",
                type:"post",
                url:urls,
                async:true,
                data:{
                    id: val
                },
                success:function(wbObj){
                  $.each(wbObj,function(i,v){
                    if(v.id == agent_id){
                        con += '<option value='+v.id+' selected>'+v.name+'</option>';
                    }else{
                        con += '<option value='+v.id+'>'+v.name+'</option>';
                    }
                  })
                  $('#agent_id').html(con)
                }
            });
        })
        $('#merchant_id').trigger('change')
    </script>




