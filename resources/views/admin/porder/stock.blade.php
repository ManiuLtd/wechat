@extends("layouts.admin")


@section('btitle')
	用户管理
@endsection


@section('bread')
	{{link_to_route('admin.admin.index','首页')}} / {{link_to_route('admin.user.index','用户管理')}} / 流量库存
@endsection


@section('title')
	流量库存
@endsection

@section('content')
  <div class="table-responsive">
	 <table class="table  table-striped">
        <tr>
            <th>所属分类</th>
            <th>产品名称</th>
            <th>总订购量</th>
            <th>已使用数量</th>
            <th>余量</th>
        </tr>

        @foreach($details as $val)
          <tr>

            <td>{{$val->good->product->name}}</td>
            <td>{{$val->good->productName}}</td>
            <td>{{$val->totalStock}}</td>
            <td>{{$val->totalUsedCnt}}</td>
            <td>{{$val->totalUnsedCnt}}</td>

          </tr>
        @endforeach
      </table>
  </div>
@endsection
