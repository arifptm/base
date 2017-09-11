@extends('template.layout')

@section('header-scripts')
  <link rel="stylesheet" href="/bower_components/AdminLTE/plugins/iCheck/flat/purple.css">
@endsection

@section('footer-scripts')
@endsection 

@section('content-top')
  <h1>Permintaan <b>{{ $order->user->name }}</b></h1>  
  Tanggal: {{ $order->updated_at->format('d M Y') }}
@endsection

@section('content-main')
<div class="box box-primary">
  <div class="box-body">
    <table class="table table-bordered table-hover">
      <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Nama Barang</th>
        <th>Qty</th>
      </tr>
      @foreach($order->lineitem as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td><img src="/assets/products/{{ $item->product->image }}" alt="" height='50'></td>
          <td>{{ $item->product->name }}</td>
          <td>{{ $item->quantity }}</td>
        
        </tr>
      @endforeach
    </table>
    <div class="box-footer">
      <a class=" btn bg-green" href="/manage/accept-order/{{$order->id}}">Terima Permintaan</a>
      <a class=" btn bg-red" href="/manage/reject-order/{{$order->id}}">Tolak Permintaan</a>
          
          <a class=" btn btn-primary" href="/export-pdf/{{$order->id}}">Export ke PDF</a>
        
    </div>
  </div>
</div>
@endsection	


