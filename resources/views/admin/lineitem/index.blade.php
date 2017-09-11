@extends('admin.template.layout')

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
    Users
    <small>All Product</small>
    <a href="/manage/products/create"><i class="fa fa-plus-circle"></i></a>
  </h1>
@endsection

@section('content-main')
  <div class="box">    
    <div class="box-body">
      <table class="table table-bordered">
        <tr>
          
          <th style="width: 40px">ID</th>
          <th style="width: 100px">Gambar</th>
          <th>Tanggal</th>
          <th>Name</th>
          <th>Referensi</th>
          <th>~Harga</th>
          <th>Stok</th>
          <th>Penempatan</th>
          <th>Habis pakai</th>
          <th style="width: 64px">Action</th>
        </tr>
        @if (count($products) == 0)
          Gak ada data
        @endif

          @foreach ($products as $product)
            <tr>
              <td>
                {{ $product->id }}
              </td>
              <td>
              	<a href="/manage/products/{{$product->id}}"><img src="/assets/products/{{ $product->image }}" alt="" height="30" /></a>
              </td>
              <td>
                {{ \Carbon\carbon::parse($product->register_date)->format('d-m-y') }}
              </td>
              <td>
              	{{ $product->name }}
              </td>
              <td>
                {{ $product->url }}
              </td>
              <td>
                {{ number_format($product->price,0,',','.') }}
              </td>              
              <td>
                {{ number_format($product->stock,0,',','.') }}
              </td>
              <td>
                {{ $product->placement }}
              </td>    
              <td>
                @if ($product->disposable == 1) <span class="label label-primary">Habis pakai</span> @else <span class="label label-primary">Tidak</span> @endif
              </td>          
              <td>
                {!! Form::open(['url' => '/manage/products/'.$product->id, 'method' => 'delete']) !!}
                <div class='btn-group'>
                  <a href="/manage/products/{{$product->id}}/edit" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}	                  
              </td>
            </tr>
          @endforeach

      </table>
    </div>
    
    <div class="box-footer clearfix">
<!--       @if (count($products) > 0)
      <div class="pull-left pagination">  
        {!! Form::model($product, ['action'=> ['UserController@index'], 'role' => 'form']) !!}
          {!! Form::button('Massal', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
          {!! Form::hidden('ids', '0', ['class'=>'selected-id']) !!}
        {!! Form::close() !!} 
      </div>
      @endif -->
      {{ $products->links('vendor.pagination.bootstrap-4') }}  
    </div>
  </div>

@endsection