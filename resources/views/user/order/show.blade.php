@extends('template.layout')

@section('header-scripts')
@endsection

@section('footer-scripts')
@endsection 

@section('content-top')
  <h1>Rencana Permintaan <small># {{ $order->id}}</small></h1>
@endsection 

@section('content-main')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
      <h3 class='box-title'>Nama User : <b>{{ $order->user->name }}</b></h3>
      </div>
      <div class="box-body">  
        <table class="table table-borbered">
          <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Hapus</th>
          </tr>
          
          @foreach($order->lineitem as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td><img height="45" src="/assets/products/{{ $item->product->image }}" alt=""></td>
            <td>
              {{ $item->product->name }}
            </td>
            <td>
              {{ $item->quantity }}
            </td> 
            <td>
              {!! Form::open(['url' => '/orders/'.$item->product->id, 'method' => 'delete']) !!}
              <div class='btn-group'>
                <a href="/orders/{{$order->id}}/edit" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
              </div>
              {!! Form::close() !!}                   
            </td>                       
          </tr>
          @endforeach
        </table>  
      </div>
      <div class="box-footer">
        {!! Form::model($order, ['action'=> ['OrderController@update', $order->id], 'method'=>'patch', 'role' => 'form']) !!}
          {!! Form::button('Kirim Permintaan', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
          <a class=" btn btn-primary" href="/home">Tambah permintaan lain</a>
          <a class=" btn btn-primary" href="/export-pdf/{{$order->id}}">Export ke PDF</a>
        {!! Form::close() !!} 
      </div>
    </div>
  </div>
</div>
@endsection	



