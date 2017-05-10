@extends("layouts.admin")

@section('btitle')
    用户管理
@endsection


@section('bread')
    {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.user.index','用户管理')}}  / 订单详情
@endsection

@section('title')
    订单详情
@endsection

@section('content')

                     
    <div class="panel">
        @include('custom/_status')
        <!--Data Table-->
        <!--===================================================-->
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
                            <th>订单号</th>
                            <th>所属分类</th>
                            <th>商品名称</th>
                            <th>销售id</th>
                            <th>数量</th>
                            <th>单价</th>
                            <th>总价</th>
                            <th>已使用量</th>
                            <th>未使用量</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($details as $detail)
                            <tr>
                                <td>{{$detail->id}}</td>
                                <td>{{$detail->order->order_num}}</td>
                                <td>{{$detail->good->product->name}}</td>
                                <td>{{$detail->good->productName}}</td>
                                <td>{{$detail->saleId}}</td>
                                <td>{{$detail->stock}}</td>
                                <td>{{$detail->price}}</td>
                                <td>￥{{$detail->stock * $detail->price}}</td>
                                <td>{{$detail->usedCnt}}</td>
                                <td>{{$detail->unUsedCnt}}</td>
                                <td>
                                    {{ link_to_route('admin.detail.useds', '明细', $parameters = ['id'=>$detail->id], $attributes = ['class'=>'btn btn-info btn-sm']) }}
                                    {{ link_to_route('admin.details.export', '导出明细', $parameters = ['id'=>$detail->id], $attributes = ['class'=>'btn btn-primary btn-sm']) }}
                                    
                                </td>
                            </tr>
                        @endforeach
       
                    </tbody>
                </table>
            </div>
            <hr>
        
        </div>
    </div>
                 
                    
@endsection



    
     
                    
                   
                    
                   
            