@extends("layouts.admin")


@section('btitle')
	用户管理
@endsection

@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.user.index','用户管理')}} / 流量库存
@endsection

@section('title')
	流量库存
@endsection

@section('content')

<style>
.mar10{
  margin:20px 0px;
}

label{
  padding-top:6px;
}
</style>

    <div id="page-content">
         @include('custom/_status')

     {!! Form::open(['route'=>['admin.user.stock',$id],'method'=>'get']) !!} 
            <div class="row mar10">
                <div class="btn-group bootstrap-select col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <label class="col-sm-3 control-label">运营商名称</label>
                    <select id="merchant_id" name="merchant_id" tabindex="2" style="width:180px"  }}>
                        <option value="" >请选择运营商</option>
                        @foreach($merchants as $merchant)
                            <option value="{{$merchant->id}}">{{$merchant->name}}</option>
                        @endforeach
                    </select>
                </div>

                   <div class="btn-group bootstrap-select col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <label class="col-sm-3 control-label">流量可用区</label>
                    <select id="agent_id" name="agent_id" tabindex="2" style="width:180px">
                        <option value="" >请选择流量可用区</option>
                        @foreach($agents as $agent)
                            <option value="{{$agent->id}}" >{{$agent->name}}</option>
                        @endforeach
                    </select>
                </div>

                  <div class="btn-group bootstrap-select col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <label class="col-sm-3 control-label">套餐名称</label>
                    <select id="product_id" name='product_id' tabindex="2" style="width:180px">
                        <option value="" >请选择套餐名称</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
            
            </div>

      
            <div class="row mar10">
                <div class="form-group" style="padding-left:22px">
                    <button class="btn btn-default btn-sm">查询</button>
                   
                    {{ link_to_route('admin.user.stock','清空',$id,['class'=>'btn btn-default btn-sm'])}}
                </div>
            </div>
        {!! Form::close() !!}
    </div>

  <div class="table-responsive">
	 <table class="table  table-striped">
        <tr>
            <th>套餐</th>
            <th>名称</th>
            <th>类型</th>
            <th>总订购量</th>
            <th>已使用数量</th>
            <th>余量</th>
        </tr>

        @foreach($datas as $val)
          <tr>
            <td>{{$val->product_name}}</td>
            <td>{{$val->productName}}</td>
            <td>{{$val->saleType ? '国内' : '省内'}}</td>
            <td>{{$val->totalStock}}</td>
            <td>{{$val->totalUsedCnt}}</td>
            <td>{{$val->totalUnusedCnt}}</td>
          </tr>
        @endforeach
      </table>
  </div>
@endsection


@section('myJs')
 <link href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/chosen/chosen.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/noUiSlider/nouislider.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <!--     <link href="{{asset('plugins/pace/pace.min.css')}}" rel="stylesheet"> layout中有-->

    <script src="{{asset('plugins/pace/pace.min.js')}}"></script>
    <script src="{{asset('plugins/switchery/switchery.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{asset('plugins/chosen/chosen.jquery.min.js')}}"></script>

    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

    <script>
          $(document).ready(function () {
              var myP=new Array("user_id","merchant_id","agent_id","product_id");

              $.each(myP,function(i,v){
                    $('#'+v).chosen();
                   // $('#'+v).chosen({width: '100%'});
              })
          });

          function getParameters()
          {
              //返回当前 URL 的查询部分（问号 ? 之后的部分）。
              var urlParameters = location.search;

              //声明并初始化接收请求参数的对象
              var requestParameters = new Object();
              //如果该求青中有请求的参数，则获取请求的参数，否则打印提示此请求没有请求的参数
              if (urlParameters.indexOf('?') != -1)
              {
                  //获取请求参数的字符串
                  var parameters = decodeURI(urlParameters.substr(1));
                  //将请求的参数以&分割中字符串数组
                  parameterArray = parameters.split('&');
                  //循环遍历，将请求的参数封装到请求参数的对象之中
                  for (var i = 0; i < parameterArray.length; i++) {
                      requestParameters[parameterArray[i].split('=')[0]] = (parameterArray[i].split('=')[1]);
                  }
                 // console.info('theRequest is =====',requestParameters);
              }
              
              return requestParameters;
          }

          var pObj = getParameters()


         $.each(pObj,function(i,v){
              $('#'+i).val(v)
         })
    </script>
@endsection
