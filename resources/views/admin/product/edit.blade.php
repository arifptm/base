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

    $('.approve').on('ifChecked', function(event){
      $('#leftpanel, #rightpanel').removeClass('hidden')
    }); 

    $('.approve').on('ifUnchecked', function(event){
      $('#leftpanel, #rightpanel').addClass('hidden')
    }); 

  </script>
@endsection 



@section('content-top')
  @include('flash::message')
  <h1>
    Edit Product
  </h1>
@endsection


@section('content-main')
<div class="box box-primary">
    {!! Form::model($product, ['action'=> ['ProductController@update', $product->id], 'method'=>'patch', 'role' => 'form', 'files'=>true]) !!}
        @include('admin.product.fields')  
    {!! Form::close() !!}
</div>
@endsection	


