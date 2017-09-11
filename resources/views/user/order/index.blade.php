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
    Riwayat Permintaan
    <a class="btn btn-primary" href="/home"><i class="fa fa-plus-circle"></i> Tambah Permintaan</a>
  </h1>
@endsection

@section('content-main')
  <div class="row">    
    <div class="col-md-8">    
      <div class="box">
        <div class="box-header with-border">
          <h3 class='box-title'>Permintaan : <b>{{ Auth::user()->name }}</b></h3>
        </div>    
        <div class="box-body">
          <table class="table table-bordered">
            <tr>          
              <th style="width: 40px">ID</th>
              <th style="width: 80px">Tanggal</th>
              <th>Nama Barang<span class="pull-right">Jumlah</span></th>
              <th>Status</th>
              <th style="width: 64px">Action</th>
            </tr>

              @foreach ($user_orders as $user_order)
                <tr>
                  <td>
                    {{ $user_order->id }}
                  </td>
                  <td>
                    {{ \Carbon\carbon::parse($user_order->created_at)->format('d-m-y') }}
                  </td>
                  <td>
                    @foreach($user_order->lineitem as $n=>$item)
                       <div>{{ $n+1 }}. {{ $item->product->name }}<span class="pull-right">{{ $item->quantity }}</span> </div>
                    @endforeach
                    
                  </td>              
                  <td>
                  	@if ($user_order->status == 'NewOrder')
                      <div class="badge bg-orange">Pending</div>
                    @elseif ($user_order->status == 'Completed')
                      <div class="badge bg-green">Completed</div>
                    @elseif ($user_order->status == 'InProgress')
                      <div class="badge bg-blue">InProgress</div>
                    @endif
                  </td>
                  
                  <td>
                    {!! Form::open(['url' => '/manage/orders/'.$user_order->id, 'method' => 'delete']) !!}
                    <div class='btn-group'>
                      <a href="/manage/orders/{{$user_order->id}}/edit" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                      {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}	                  
                  </td>
                </tr>
              @endforeach
             @if (count($user_orders) == 0)
            <tr><td colspan='8'><h2>Tidak ada data!</h2></td></tr>
            @endif
          </table>
        </div>
        @if($user_orders->links() != '')
          <div class="box-footer clearfix">
      <!--       @if (count($user_orders) > 0)
            <div class="pull-left pagination">  
              {!! Form::model($user_order, ['action'=> ['UserController@index'], 'role' => 'form']) !!}
                {!! Form::button('Massal', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                {!! Form::hidden('ids', '0', ['class'=>'selected-id']) !!}
              {!! Form::close() !!} 
            </div>
            @endif -->
            {{ $user_orders->links('vendor.pagination.bootstrap-4') }}  
          </div>
        @endif

      </div>
    </div>

    <div class="col-md-4">
      <div class="box">
        <div class="box-header with-border">
          <h3 class='box-title'>Daftar semua permintaan</h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered">
            <tr>          
              <th style="width: 40px">ID</th>
              <th style="width: 80px">Tanggal</th>
              <th>Nama user</th>
              <th>Status</th>
            </tr>
            @if (count($all_orders) > 0)
              @foreach ($all_orders as $all_order)
                <tr>
                  <td>
                    {{ $all_order->id }}
                  </td>
                  <td>
                    {{ \Carbon\carbon::parse($all_order->created_at)->format('d-m-y') }}
                  </td>
                  <td>
                    {{ $all_order->user->name }}
                  </td>              
                  <td>
                    @if ($all_order->status == 'NewOrder')
                      <div class="badge bg-orange">Pending</div>
                    @elseif ($all_order->status == 'Completed')
                      <div class="badge bg-green">Completed</div>
                    @elseif ($all_order->status == 'InProgress')
                      <div class="badge bg-blue">InProgress</div>
                    @endif
                  </td>
                </tr>
              @endforeach
            @endif
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection