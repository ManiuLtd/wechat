@extends("layouts.admin")

@section('btitle')
    明细
@endsection


@section('bread')
    {{link_to_route('admin.admin.index','首页')}} / 订单使用明细
@endsection

@section('title')
    订单使用明细 
@endsection


@section('content')

          
    <div class="panel">

        @include('custom/_status')

        <div class="panel-body">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
              
                    </div>
                   
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>请求id</th>
                            <th>手机号</th>
                            <th>商品销售id</th>
                            <th>商品名称</th>
                            <th>状态</th>
                            <th>创建时间</th>
                    
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($datas as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->reqId}}</td>
                                <td>{{$data->phone}}</td>
                                <td>{{$data->saleId}}</td>
                                <td>{{$data->detail->good->productName}}</td>
                                <td>{{$data->status}}</td>
                                <td >
                                   {{$data->created_at}}
                                </td>
          
                            </tr>
                        @endforeach
       
                    </tbody>
                </table>
            </div>
            <hr>
         

            {!! $datas->links() !!}
         

        </div>
    </div>
                 
                    
@endsection



    
     
                    
                   
                    
                   
            