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
    Riwayat Usulan
    <a href="/products/create" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Usulan</a>
  </h1>
@endsection

@section('content-main')
  <div class="row">
    @if ($suggestions) <div class="col-md-8"> @else <div class="col-md-12"> @endif
      <div class="box">    
      <div class="box-header with-border">
        <h3 class="box-title">Usulan : <b>{{ Auth::user()->name }}</b></h3>
      </div>
      <div class="box-body">
        <table class="table table-bordered">
          <tr>          
            <th style="width: 40px">ID</th>
            <th style="width: 70px">Gambar</th>
            <th style="width: 80px">Tanggal</th>
            <th>Names</th>
            <th>~Harga</th>
            <th>Status</th>
            <th style="width: 64px">Action</th>
          </tr>
            @foreach ($products as $product)
              <tr>
                <td>
                  {{ $product->id }}
                </td>
                <td>
                	<a href="/products/{{$product->id}}"><img src="/assets/products/{{ $product->image }}" alt="" height="30" /></a>
                </td>
                <td>
                  {{ \Carbon\carbon::parse($product->register_date)->format('d-m-y') }}
                </td>
                <td>
                	{{ $product->name }}
                </td>
                <td>
                  {{ number_format($product->price,0,',','.') }}
                </td>
                <td>
                  @if($product->verified == 1)
                    <span class="badge bg-green">Diterima</span>
                  @elseif($product->verified == 0)
                    <span class="badge bg-orange">Pending</span>
                  @elseif($product->verified == 9)
                    <span class="badge bg-red">Ditolak</span>
                  @endif
                </td>
                <td>
                  {!! Form::open(['url' => '/products/'.$product->id, 'method' => 'delete']) !!}
                  <div class='btn-group'>
                    <a href="/products/{{$product->id}}/edit" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                  </div>
                  {!! Form::close() !!}	                  
                </td>
              </tr>
            @endforeach
            @if (count($products) == 0)
            <tr><td colspan='8'><h2>Tidak ada data!</h2></td></tr>
            @endif

        </table>
      </div>
      
      <div class="box-footer clearfix">
        {{ $products->links('vendor.pagination.bootstrap-4') }}  
      </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Usulan user lain</h3>
        </div>
        <div class="box-body">
          <table class="table-bordered table table-hover">
            <tr>
              <th>#</th>
              <th>Nama Barang</th>
              <th>Nama User</th>
              <th>Status</th>
            </tr>
            @foreach($suggestions as $suggestion)
            <tr>
              <td>{{ $loop->iteration }} </td>
              <td>{{ $suggestion->name }} </td>
              <td>{{ $suggestion->user->name }} </td>
              <td>
              @if ($suggestion->verified == 0)
                  <span class="badge bg-blue">Pending</span>
              @elseif ($suggestion->verified == 1)
                  <span class="badge bg-green">Diterima</span>
              @elseif ($suggestion->verified == 9)
                  <span class="badge bg-red">Ditolak</span>
              @endif
              </td>
            </tr>
            @endforeach
          </table>        
        </div>
      </div>
    </div>
  </div>

@endsection
