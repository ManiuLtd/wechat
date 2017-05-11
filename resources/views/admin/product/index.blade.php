@extends("layouts.admin")

@section('btitle')
    流量产品管理
@endsection


@section('bread')
    {{link_to_route('admin.product.index','首页')}} / {{link_to_route('admin.product.index','流量产品列表')}} 
@endsection

@section('title')
    流量产品列表
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
                       {{link_to_route('admin.product.create','添加','',['class'=>'btn btn-info'])}}
                    </div>
                   
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>产品名称</th>
                            <th>时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td >{{$product->created_at}}</td>
                                <td>
                                    <button  class='btn btn-info btn-sm'>
                                        {{link_to_route('admin.product.edit','编辑',['id'=>$product->id])}}
                                    </button>

                                    <button  class='btn btn-primary btn-sm'>
                                        {{link_to_route('good.index','查看商品',['id'=>$product->id])}}
                                    </button>
                                    
                                    @include('admin/product/_deleteForm')
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



    
     
                    
                   
                    
                   
            