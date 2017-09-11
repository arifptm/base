@extends('template.layout')

@section('header-scripts')
@endsection

@section('footer-scripts')
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
        <table class="table table-bordered table-hover">
          <tr>
            <th style="width:130px;">Habis Pakai</th><td>@if ($product->disposable == 1) <span class="label label-primary">Habis pakai</span> @else <span class="label label-primary">Tidak</span> @endif</td>
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
            <th>Link Referensi</th><td>{{ $product -> url }}</td>
          </tr>
          <tr>
            <th>Keterangan</th><td>{{ $product -> body }}</td>
          </tr>
          <tr >
            @if ($product->verified == 1 )
              <!-- <td colspan="2"><a href="/manage/products/{{$product->id}}/edit" class="btn btn-primary btn-lg">Proses Permintaan Barang</a></td> -->
            @elseif ($product->verified == 0 )
              <td colspan="2"><a href="/manage/products/{{$product->id}}/edit" class="btn btn-primary btn-lg">Proses Usulan Barang</a></td>
            @endif
          </tr>

        </table>
        
      </div>
    </div>
  </div>
</div>
@endsection	



