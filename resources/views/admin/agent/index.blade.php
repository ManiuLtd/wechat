@extends("layouts.admin")

@section('btitle')
    代理商管理
@endsection


@section('bread')
    {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.agent.index','代理商管理')}} / 代理商列表
@endsection

@section('title')
    代理商列表
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
                        </i>{{link_to_route('admin.agent.create',"添加",'',['class'=>'btn btn-info'])}}
                    </div>
                   
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>代理商名称</th>
                            <th>所属运营商</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($agents as $agent)
                           <tr>
                            <td>{{$agent->id}}</td>
                            <td>{{$agent->name}}</td>
                            <td>{{$agent->merchant->name}}</td>
                            <td>
                                {{link_to_route('admin.agent.edit','编辑',['id'=>$agent->id],['class'=>'btn btn-info'])}}
                                {{link_to_route('admin.agent.goods','查看商品',['id'=>$agent->id],['class'=>'btn btn-primary'])}}
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



    
     
                    
                   
                    
                   
            