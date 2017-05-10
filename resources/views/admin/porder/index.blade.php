@extends("layouts.admin")

@section('btitle')
    用户管理
@endsection


@section('bread')
    {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.user.index','用户管理')}} / 个人订购记录
@endsection

@section('title')
    个人订购记录
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
                            <th>手机号</th>
                            <th>套餐</th>
                            <th>金额</th>
                            <th>支付状态</th>
                            <th>订单时间</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->order_num}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->good->product->name}}</td>
                                <td>{{$order->price}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->created_at}}</td>
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



    
     
                    
                   
                    
                   
            