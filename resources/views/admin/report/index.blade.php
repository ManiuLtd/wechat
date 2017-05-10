@extends("layouts.admin")

@section('btitle')
    报表管理
@endsection


@section('bread')
    {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('order.report','报表管理')}} /  下家订购报表
@endsection

@section('title')
    下家订购报表
@endsection

@section('content')

    <style>
        .mar10 {
            margin: 10px !important;
        }
    </style>

    <div id="page-content">
         @include('custom/_status')
        {!! Form::open(['route'=>['order.report'],'method'=>'get']) !!}
            <div class="row mar10">

                <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                    <label class="col-sm-3 control-label">代理商名称</label>
                    <select id="user_id" name="user_id" tabindex="2" style="width:180px"  }}>
                        <option value="" >请选择代理商</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" >{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                    <label class="col-sm-3 control-label">所属运营商</label>
                    <select id="merchant_id" name="merchant_id" tabindex="2" style="width:180px">
                        <option value="" >请选择运营商</option>
                        @foreach($merchants as $merchant)
                            <option value="{{$merchant->id}}">{{$merchant->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mar10">

                <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                    <label class="col-sm-3 control-label" {{session('start_time')}}>开始日期</label>
                    <input type="date" name="start_time" id="start_time" min="2017-04-1"
                           style="width:180px;height:30px;border: 1px solid #e1e5ea;background-color: #fff; color: #677581;padding-left:15px"/>
                </div>


                <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                    <label class="col-sm-3 control-label">结束日期</label>
                    <input type="date" name="end_time" id="end_time" min="2017-04-1"
                           style="width:180px;height:30px;border: 1px solid #e1e5ea;background-color: #fff; color: #677581;padding-left:15px"/>
                </div>
            </div>

            <div class="row mar10">

                <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                    <label class="col-sm-3 control-label">所属分类</label>
                    <select id="product_id" name='product_id' tabindex="2" style="width:180px">
                        <option value="" >请选择分类名称</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach

                    </select>
                </div>


                <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                    <label class="col-sm-3 control-label">流量可用区</label>
                    <select id="agent_id" name="agent_id" tabindex="2" style="width:180px">
                        <option value="" >请选择流量可用区</option>
                        @foreach($agents as $agent)
                            <option value="{{$agent->id}}" >{{$agent->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mar10">
                <div class="form-group" style="padding-left:22px">
                    <button class="btn btn-default btn-sm">查询</button>
                   
                    {{ link_to_route('order.report','清空','',['class'=>'btn btn-default btn-sm'])}}
                </div>
            </div>
        {!! Form::close() !!}
    </div>


    <div class="panel">
        <div class="panel-heading">
            <h5 class="panel-title">查询结果</h5>
        </div>
        <div class="panel-body">
            <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>所属分类</th>
                    <th>代理商名称</th>
                    <th>订单号</th>
                    <th class="min-tablet">所属运营商</th>
                    <th class="min-desktop">流量可用区</th>
                    <th class="min-desktop">产品名称</th>
                    <th class="min-tablet">数量</th>
                    <th class="min-tablet">单价</th>
                    <th class="min-desktop">合计费用</th>
                    <th class="min-desktop">已使用量</th>
                    <th class="min-desktop">未使用量</th>
                    <th class="min-desktop">订单时间</th>
                    <th class="min-desktop">操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->product_name}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->order_num}}</td>
                        <td>{{$data->merchant_name}}</td>
                        <td>{{$data->agent_name}}</td>
                        <td>{{$data->productName}}</td>
                        <td>{{$data->stock}}</td>
                        <td>{{$data->price}}</td>
                        <td>￥{{$data->stock * $data->price}}</td>
                        <td>{{$data->usedCnt}}</td>
                        <td>{{$data->unUsedCnt}}</td>
                        <td>{{$data->order_time}}</td>
                        <td>
                            {{ link_to_route('admin.detail.useds', '明细', $parameters = ['id'=>$data->detail_id], $attributes = ['class'=>'btn btn-info btn-sm']) }}
                            {{ link_to_route('admin.details.export', '导出明细', $parameters = ['id'=>$data->detail_id], $attributes = ['class'=>'btn btn-primary btn-sm']) }}
                        </td>
                        
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>




@endsection


@section('myJs')

    <script src="{{asset('plugins/pace/pace.min.js')}}"></script>
    <script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/nifty.min.js')}}"></script>
    <script src="{{asset('js/demo/nifty-demo.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/demo/tables-datatables.js')}}"></script>
    <!--
    <link href="{{asset('plugins/switchery/switchery.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
 -->

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















