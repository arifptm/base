<!DOCTYPE html>
<html>
<head>
  <style>

  body{
    color:#666;
  }

    table{
      border:2px solid #999;
      border-collapse: collapse;
      font-size: 1em;
    }

    td,th {
      border: 1px solid #aaa;
      padding:6px 10px;
    }

    th{
      background-color: #eee;
      font-weight: bold;
    }

  </style>
</head>
<body class="hold-transition skin-purple fixed sidebar-mini">
  <div>{{ $order->updated_at->format('d M Y') }}</div>
  
  <h1>Permintaan # {{ $order->id }}</h1>
  
  <h2>Nama User : {{ $order->user->name }}</h2>

  <table style="border:1px solid #ccc;">
    <tr>
      <th>No.</th>            
      <th>Nama Barang</th>
      <th>Jumlah</th>
    </tr>
    
    @foreach($order->lineitem as $item)
    <tr>
      <td>{{ $loop->iteration }}</td>            
      <td>
        {{ $item->product->name }}
      </td>
      <td>
        {{ $item->quantity }}
      </td>                       
    </tr>
    @endforeach
  </table>  
</body>
</html>