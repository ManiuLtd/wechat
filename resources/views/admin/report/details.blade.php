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
        <div class="row mar10">

            <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                <label class="col-sm-3 control-label">代理商名称</label>
                <select id="demo-chosen-select3" tabindex="2" style="width:150px">

                    <option value="United Kingdom">广州创蓝</option>
                    <option value="Afghanistan">广州创蓝</option>
                    <option value="Aland Islands">广州创蓝</option>
                    <option value="Albania">广州创蓝</option>
                    <option value="Algeria">广州创蓝</option>
                </select>
            </div>


            <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                <label class="col-sm-3 control-label">所属运营商</label>
                <select id="demo-chosen-select2" tabindex="2" style="width:150px">
                    <option value="United States">中国电信</option>
                    <option value="United Kingdom">中国移动</option>
                    <option value="Afghanistan">中国联通</option>

                </select>
            </div>

        </div>

        <div class="row mar10">

            <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                <label class="col-sm-3 control-label">开始日期</label>
                <input type="date" value="2015-09-24" min="2017-04-1"
                       style="width:150px;height:30px;border: 1px solid #e1e5ea;background-color: #fff; color: #677581;padding-left:15px"/>
            </div>


            <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                <label class="col-sm-3 control-label">结束日期</label>
                <input type="date" value="2015-09-24" min="2017-04-1"
                       style="width:150px;height:30px;border: 1px solid #e1e5ea;background-color: #fff; color: #677581;padding-left:15px"/>
            </div>

        </div>

        <div class="row mar10">

            <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                <label class="col-sm-3 control-label">产品名称</label>
                <select id="demo-chosen-select1" tabindex="2" style="width:150px">

                    <option value="United Kingdom">30M</option>
                    <option value="Afghanistan">500M</option>
                    <option value="Aland Islands">1G</option>
                    <option value="Aland Islands">2G</option>

                </select>
            </div>


            <div class="btn-group bootstrap-select col-xs-6 col-sm-4 col-md-6 col-lg-6">
                <label class="col-sm-3 control-label">流量可用区</label>
                <select id="demo-chosen-select" tabindex="2" style="width:150px">

                    <option value="United Kingdom">江苏电信</option>
                    <option value="Afghanistan">江苏移动</option>
                    <option value="Aland Islands">江苏联通</option>

                </select>
            </div>

        </div>

        <div class="row mar10">
            <div class="form-group" style="padding-left:22px">
                <button class="btn btn-default btn-sm">查询</button>
                <button class="btn btn-default btn-sm">清空</button>
            </div>
        </div>

    </div>


    <div class="panel">
        <div class="panel-heading">
            <h5 class="panel-title">查询结果</h5>
        </div>
        <div class="panel-body">
            <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>代理商名称</th>
                    <th>产品名称</th>
                    <th class="min-tablet">所属运营商</th>
                    <th class="min-tablet">数量</th>
                    <th class="min-desktop">合计费用：RMB</th>
                    <th class="min-desktop">流量可以区</th>
                    <th class="min-desktop">已使用量</th>
                    <th class="min-desktop">未使用量</th>
                    <th class="min-desktop">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->user->cname}}</td>
                        <td>{{$order->productName}}</td>
                        <td></td>
                        <td>{{$order->stock}}</td>
                        <td>{{$order->total}}</td>
                        <td>{{$order->total}}</td>
                        <td>{{$order->usedCnt}}</td>
                        <td>{{$order->unusedCnt}}</td>
                        <td>
                            <button class="btn">明细</button>
                            <button class="btn">导出明细</button>
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

            $('#demo-chosen-select').chosen();
            $('#demo-cs-multiselect').chosen({width: '100%'});

            $('#demo-chosen-select1').chosen();
            $('#demo-cs-multiselect1').chosen({width: '100%'});

            $('#demo-chosen-select2').chosen();
            $('#demo-cs-multiselect2').chosen({width: '100%'});

            $('#demo-chosen-select3').chosen();
            $('#demo-cs-multiselect3').chosen({width: '100%'});

        });

    </script>
@endsection















