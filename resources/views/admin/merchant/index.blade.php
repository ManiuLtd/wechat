@extends("layouts.admin")

@section('btitle')
    运营商管理
@endsection


@section('bread')
    {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.merchant.index','运营商管理')}} / 运营商列表
@endsection

@section('title')
    运营商列表
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
                        </i>{{link_to_route('admin.merchant.create',"添加",'',['class'=>'btn btn-info'])}}
                    </div>
                   
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>运营商名称</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($merchants as $merchant)
                           <tr>
                            <td>{{$merchant->id}}</td>
                            <td>{{$merchant->name}}</td>
                            <td>
                                {{ link_to_route('admin.merchant.edit', '编辑', $parameters = ['id'=>$merchant->id], $attributes = ['class'=>'btn btn-info btn-sm']) }}
                                {{ link_to_route('admin.merchant.agents', '查看代理商', $parameters = ['id'=>$merchant->id], $attributes = ['class'=>'btn btn-primary btn-sm']) }}
                                 @include('admin/merchant/_deleteForm')
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



    
     
                    
                   
                    
                   
            