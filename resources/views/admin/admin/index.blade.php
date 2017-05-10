@extends("layouts.admin")

@section('btitle')
    管理员
@endsection


@section('bread')
    {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.admin.index','管理员')}} / 管理员列表
@endsection

@section('title')
    管理员列表
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
                        <button class="btn btn-info"><i class="demo-pli-add icon-fw"></i>{{link_to_route('admin.admin.create','添加')}}</button>
                    </div>
                   
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>用户名</th>
                            <th>邮箱</th>
                            <th>状态</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($admins as $admin)
                            <tr>
                                <td>{{$admin->id}}</td>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->email}}</td>
                                <td>
                                     @include('admin/admin/_statusForm')
                                </td>
                                <td >
                                   {{$admin->created_at}}
                                </td>
                                <td>
                                    {{ link_to_route('admin.admin.edit', '编辑管理员', $parameters = ['id'=>$admin->id], $attributes = ['class'=>'btn btn-info btn-sm']) }}
                                    
                                    @include('admin/admin/_deleteForm')
                                </td>
                            </tr>
                        @endforeach
       
                    </tbody>
                </table>
            </div>
            <hr>
         

            {!! $admins->links() !!}
         

        </div>
    </div>
                 
                    
@endsection



    
     
                    
                   
                    
                   
            