@extends("layouts.admin")

@section('btitle')
    代理商管理 
@endsection


@section('bread')
     {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.agent.index','代理商管理')}} / {{link_to_route('admin.agent.index','代理商列表')}} / 商品列表
@endsection

@section('title')
    商品列表
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
                       {{link_to_route('good.create','添加','',['class'=>'btn btn-info'])}}
                    </div>
                   
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>商品名称</th>
                        <!--     <th>商品类型</th> -->
                            <th>商品销售id</th>
                            <th>销售类型</th>
                            <th>流量可用区</th>
                            <th>原价</th>
                            <th>价格</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($goods as $good)
                            <tr>
                                <td>{{$good->id}}</td>
                             <!--    <td>{{$good->productName}}</td> -->
                                <td >{{$good->productType}}</td>
                                <td >{{$good->saleId}}</td>
                                <td >{{$good->saleType}}</td>
                                <td >{{$good->agent->name}}</td>
                                <td >{{$good->oldMoney}}</td>
                                <td >{{$good->money}}</td>
                                <td>
                                    <button  class='btn btn-info btn-sm'>
                                       {{link_to_route('good.edit','编辑',['id'=>$good->id,'product_id'=>$id])}}
                                    </button>
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



    
     
                    
                   
                    
                   
            