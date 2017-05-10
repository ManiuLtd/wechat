@extends("layouts.admin")

@section('btitle')
    banner
@endsection


@section('bread')
    {{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.banner.index','banner')}} / banner列表
@endsection

@section('title')
    banner列表
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
                        <button class="btn btn-info"><i class="demo-pli-add icon-fw"></i>{{link_to_route('admin.banner.create','添加')}}</button>
                    </div>
                   
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>名称</th>
                            <th>图片</th>
                            <th>创建时间</th>
                            <th>操作</th> 
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($banners as $banner)
                            <tr>
                                <td>{{$banner->id}}</td>
                                <td>{{$banner->name}}</td>
                                <td><img src="{{config("qiniu.domain").$banner->link}}" width=100px height=50px></td>
                                <td >
                                   {{$banner->created_at}}
                                </td>
                                <td>
                                    {{ link_to_route('admin.banner.edit', '编辑', $parameters = ['id'=>$banner->id], $attributes = ['class'=>'btn btn-info btn-sm']) }}
                                    
                                    @include('admin/banner/_deleteForm')
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



    
     
                    
                   
                    
                   
            