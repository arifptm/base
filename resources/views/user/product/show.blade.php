@extends('template.layout')

@section('header-scripts')
@endsection

@section('footer-scripts')
   <script>
      $(function() {
         $('#myModal').on("show.bs.modal", function (e) {
            $("#datatitle").html($(e.relatedTarget).data('datatitle'));
            $("#dataimage").html($(e.relatedTarget).data('dataimage'));
            $("#dataid").attr( 'value', ($(e.relatedTarget).data('dataid')));
         });
      });
   </script>
@endsection 

@section('content-top')
  <h1>{{ $product -> name }}</h1>
@endsection 

@section('content-main')
<div class="box box-primary">
  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <img class="img-responsive" src="/assets/products/{{ $product->image }}" alt="" />
      </div>
      <div class="col-md-6">
        <table class="table table-bordered">
          <tr>
            <th style="width:140px">Habis Pakai</th><td>@if ($product->disposable == 1) <span class="label label-primary">Habis pakai</span> @else <span class="label label-primary">Tidak</span> @endif</td>
          </tr>
          <tr>
            <th>Nama Barang</th><td>{{ $product -> name }}</td>
          </tr>
          <tr>
            <th>Tanggal Masuk</th><td>{{ \Carbon\carbon::parse($product->register_date)->format('d M Y') }}</td>
          </tr>
          <tr>
            <th>Jumlah Stok</th><td>{{ $product -> stock }}</td>
          </tr>
          <tr>
            <th>Perkiraan Harga</th><td>Rp. {{ number_format($product -> price,0,',','.') }},-</td>
          </tr>
          <tr>
            <th>Link Referensi</th><td><a target="_blank" href="{{ $product -> url }}">{{ str_limit($product -> url,80) }}</td>
          </tr>
          <tr>
            <th>Keterangan</th><td>{{ $product -> body }}</td>
          </tr>
          <tr >
            <td colspan="2">{!! Form::button('Tambah Permintaan Barang Ini',['data-target'=>'#myModal', 'data-toggle'=>'modal', 'id'=>'add_to_cart', 'class'=>'btn btn-primary btn-lg', 'data-datatitle'=>$product->name, 'data-dataimage'=> "<img class='img-responsive' src='/assets/products/$product->image' alt='' >" , 'data-dataid'=>$product->id]) !!}</td>
          </tr>
        </table>
        
      </div>
    </div>
  </div>
</div>

@include('user.product.modal')

@endsection	



