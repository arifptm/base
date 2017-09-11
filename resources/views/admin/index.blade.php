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
      <h1>Dashboard</h1>
@endsection

@section('content-main')
<div class="box box-primary">
    <div class="box-body">
      <div class="row">
        <div class="col-lg-4 ">
          
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $all_users->count() }} <small>Pengguna</small></h3>
 
              <p><span class="badge">{{ $admins->count() }}</span> Admin dan <span class="badge">{{ $users->count() }}</span> user</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="/manage/users" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-4">
        
          <div class="small-box bg-teal">
            <div class="inner">
              <h3>{{ $products_pending->count()}} <small>Usulan baru</small></h3>

              <p><strong><span class="badge">{{ $products_verified->count() }}</span></strong> dari <span class="badge">{{ $all_products->count() }}</span> barang sudah di-verifikasi </p>
            </div>
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
            <a href="/manage/products" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-4 ">
        
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $orders_new -> count() }} <small>Permintaan baru</small> </h3>

              <p><span class="badge">{{ $orders_completed->count() }}</span> dari <span class="badge">{{ $all_orders->count() }}</span> permintaan telah diproses</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-cart"></i>
            </div>
            <a href="/manage/orders" class="small-box-footer">Selengkapnya... <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="row">
  <div class="col-sm-4">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Pengguna</h3>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-hover">
          @foreach($all_users as $user)
            <tr>
              <td>
                <b><a href="/manage/users/{{ $user->id }}">{{ $user->name }}</a></b>
                @if ($user->verified == 1) 
                  <span class="badge bg-green">Approved</span> 
                @elseif ($user->verified == 0)
                  <span class="badge bg-orange">Pending</span> 
                @endif
                <span class="pull-right">[ ID: {{ $user->id }} ]</span>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
  
  <div class="col-sm-4">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Usulan</h3>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-hover">
          @foreach($all_products as $product)
            <tr>
              <td>{{ $product->user->name }}
                @if ($product->verified == 1) 
                  <span class="badge bg-green">Approved</span> 
                @elseif ($product->verified == 0)
                  <span class="badge bg-orange">Pending</span> 
                @elseif ($product->verified == 9)
                  <span class="badge bg-red">Rejected</span> 
                @endif
                <br>
                <a href="/manage/products/{{ $product->slug }}">{{ $product->name }}</a>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>

    <div class="col-sm-4">
    <div class="box box-primary">
      <div class="box-header">
          <h3 class="box-title">Permintaan</h3>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-hover">
          @foreach($all_orders as $order)
            <tr>
              <td>
              <b><a href="/manage/orders/{{ $order->user->id }}">{{ $order->user->name }}</a></b> 
                @if ($order->status == 'NewOrder')
                    <div class="badge bg-orange">Pending</div>
                @elseif ($order->status == 'Completed')
                    <div class="badge bg-green">Completed</div>
                @endif
                <ul>
                @foreach ($order->lineitem as $item)
                  <li>{{ $item->product->name }}</li>
                @endforeach
                </ul>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>

</div>

@endsection