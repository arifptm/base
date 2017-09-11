@extends('template.layout')

@section('header-scripts')
  <link rel="stylesheet" href="/bower_components/AdminLTE/plugins/iCheck/flat/purple.css">
@endsection

@section('footer-scripts')
  <script src="/bower_components/AdminLTE/plugins/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'description' );
  </script>
  <script src="/bower_components/AdminLTE/plugins/iCheck/icheck.min.js"></script>
  <script>
    $('input[type="checkbox"], input[type="radio"]').iCheck({
      checkboxClass: 'icheckbox_flat-purple',
      radioClass   : 'iradio_flat-purple'
    })
  </script>
@endsection 

@section('content-top')
  @include('flash::message')
  <h1>Edit Order</h1>
@endsection


@section('content-main')
<div class="box box-primary">
    {!! Form::model($order, ['action'=> ['OrderController@update', $order->id], 'method'=>'patch', 'role' => 'form', 'files'=>true]) !!}
        @include('admin.order.fields')  l
    {!! Form::close() !!}
</div>
@endsection	


