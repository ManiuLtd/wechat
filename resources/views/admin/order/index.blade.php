@extends("layouts.admin")

@section('btitle')
    用户管理
@endsection


@section('bread')
    {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.user.index','用户管理')}} / 订单列表
@endsection

@section('title')
    订单列表
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
                            <th>总价</th>
                            <th>备注</th>
                            <th>支付状态</th>
                            <th>订单时间</th>
                            <th>操作</th>
                      
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($orders as $order)
                           <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->order_num}}</td>
                            <td>{{$order->total}}</td>
                            <td>{{$order->remarks}}</td>
                            <td>
                                @if($order->status == '未支付')
                                    @include('admin/order/_statusForm')
                                @else
                                    {{$order->status}}
                                @endif
                            </td>
                            <td>{{$order->created_at}}</td>
                            <td>{{ link_to_route('admin.user.order.details', '订单详情', ['user_id'=>$user_id,'order_id'=>$order->id], ['class'=>'btn btn-info btn-sm']) }}</td>

                          </tr>
                        @endforeach
       
                    </tbody>
                </table>
            </div>
            <hr>
         

            {!! $orders->links() !!}
         

        </div>
    </div>
                 
                    
@endsection



    
     
                    
                   
                    
                   
            