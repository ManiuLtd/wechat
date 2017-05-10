@extends("layouts.admin")

@section('btitle')
    运营商管理
@endsection


@section('bread')
     {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.merchant.index','运营商管理')}} / / 代理商列表
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
                            <td>{{link_to_route('admin.agent.edit','编辑',['id'=>$agent->id],['class'=>'btn btn-info'])}}</td>
                          </tr>
                        @endforeach
       
                    </tbody>
                </table>
            </div>
            <hr>
        
        </div>
    </div>
                 
                    
@endsection



    
     
                    
                   
                    
                   
            