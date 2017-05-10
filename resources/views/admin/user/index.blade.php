@extends("layouts.admin")

@section('btitle')
    用户管理
@endsection


@section('bread')
    {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.user.index','用户管理')}} / 用户列表
@endsection

@section('title')
    用户列表
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
                            <th>公司名称</th>
                            <th>手机号</th>
                            <th>openid</th>
                            <th>微信昵称</th>
                            <th>状态</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->openid}}</td>
                                <td>{{$user->wx_nickname}}</td>
                                <td>
                                     @include('admin/user/_statusForm')
                                </td>
                                <td >
                                   {{$user->created_at}}
                                </td>
                                <td>
                                    
                                       @if($user->phone && $user->name)
                                         {{link_to_route('admin.user.order','查看企业订单',['id'=>$user->id],['class'=>'btn btn-info btn-sm'])}}
                                         {{link_to_route('admin.user.stock','库存查看',['id'=>$user->id],['class'=>'btn btn-success btn-sm'])}}
                                         {{link_to_route('admin.user.buy','创建订单',['id'=>$user->id],['class'=>'btn btn-primary btn-sm'])}}
                                       @endif
                                      
                                       {{link_to_route('admin.user.porder','个人订购记录',['id'=>$user->id],['class'=>'btn btn-info btn-sm'])}}

                                       <!--  @include('admin/user/_deleteForm') -->
                                </td>
                            </tr>
                        @endforeach
       
                    </tbody>
                </table>
            </div>
            <hr>
         

            {!! $users->links() !!}
         

        </div>
    </div>
                 
                    
@endsection



    
     
                    
                   
                    
                   
            