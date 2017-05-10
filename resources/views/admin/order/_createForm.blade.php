{!! Form::open(['route'=>['admin.user.order.store'],'method'=>'post']) !!}
    <div class="row mar10">
        <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
            <label class="col-sm-3 control-label">所属运营商</label>
            <select id="merchant_id" name="merchant_id" tabindex="2" style="width:180px"  }}>
                @foreach($merchants as $merchant)
                    <option value="{{$merchant->id}}">{{$merchant->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mar10">
       <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
            <label class="col-sm-3 control-label">所属代理商</label>
            <select id="agent_id" name="agent_id" tabindex="2" style="width:180px">
            </select>
        </div>
    </div>

    <div class="row mar10">
       <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
            <label class="col-sm-3 control-label" >订单备注</label>
            <input type='text' class='beizhu' required name='remarks'>
        </div>
    </div>

    <div class="row mar10">
       <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
            <label class="col-sm-3 control-label">选择商品</label>
           
        </div>
    </div>

    <input type='hidden' name='user_id' value="{{$user_id}}">

    <ul class="list-group" id='productlist' style='padding-left:34px'>
    </ul>


   <div class="panel-footer">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                <button class="btn btn-mint" type="submit">保存</button>
            </div>
        </div>
    </div>
{!! Form::close() !!}