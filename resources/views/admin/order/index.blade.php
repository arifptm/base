@extends('template.layout')

@section('header-scripts')
  <link rel="stylesheet" href="/bower_components/AdminLTE/plugins/iCheck/flat/purple.css">
@endsection

@section('footer-scripts')
  <script src="/bower_components/AdminLTE/plugins/iCheck/icheck.min.js"></script>
  <script src="/js/custom.js"></script>
@endsection

@section('content-top')
  @include('flash::message')
  <h1>
    Orders
    <small>All Orders</small>
  </h1>
@endsection

@section('content-main')
  <div class="box">    
    <div class="box-body">
      <table class="table table-bordered">
        <tr>
          <th style="width: 40px" class="icheck">{!! Form::checkbox("select-all",null,false, ['class'=>'flat-purple', 'id'=>'select-all']) !!}</th>
          <th style="width: 50px">ID</th>
          <th style="width: 80px">Tanggal</th>
          <th>Nama User</th>
          <th>Nama Barang</th>
          <th style="width: 140px">Status</th>          
          <th style="width: 100px">Aksi</th>
        </tr>
        @if (count($orders) > 0)
          @foreach ($orders as $order)
            <tr>
              <td class="icheck">
                {!! Form::checkbox("$order->id",null,false, ['class'=>'flat-purple item']) !!}
              </td>
              <td>
                {{ $order->id }}
              </td>
              <td>
                {{ $order->created_at->format('d M y') }}
              </td>
              <td>
                {{ $order->user->name}}
              </td>
              <td>
                <ul>
                  @foreach($order->lineitem as $item)
                    <li>{{ $item->product->name }} <span class="pull-right">{{ $item->quantity }}</span> </li>
                  @endforeach
                </ul>
              </td>
              <td>
                @if ($order->status == 'InProgress')
                      <span class="label bg-orange">Pending</span> <span><a href="/manage/orders/{{ $order->id }}" class='btn bg-blue-active btn-xs'><i class="glyphicon glyphicon-play"></i> Proses</a></span>
                @elseif ($order->status == 'Approved')
                      <span class="label bg-green">Diterima</span>
                @elseif ($order->status == 'NewOrder')
                      <span class="label bg-teal">Draft</span>
                @elseif ($order->status == 'Rejected')
                      <span class="label bg-red">Ditolak</span>
                @endif
              </td>

              <td>
                
                {!! Form::open(['url' => '/manage/orders/'.$order->id, 'method' => 'delete']) !!}
                <div class='btn-group'>
                  <a href="/manage/orders/{{$order->id}}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                  <a href="/manage/orders/{{$order->id}}/edit" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}                   
              </td>
            </tr>
          @endforeach
        @else
          Gak ada data
        @endif
      </table>
    </div>
    
    <div class="box-footer clearfix">
<!--       @if (count($orders) > 0)
      <div class="pull-left pagination">  
        {!! Form::model($order, ['action'=> ['UserController@index'], 'role' => 'form']) !!}
          {!! Form::button('Massal', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
          {!! Form::hidden('ids', '0', ['class'=>'selected-id']) !!}
        {!! Form::close() !!} 
      </div>
      @endif -->
      {{ $orders->links('vendor.pagination.bootstrap-4') }}  
    </div>
  </div>

@endsection