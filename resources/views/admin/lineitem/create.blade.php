@extends('admin.template.layout')

@section('header-scripts')
  
@endsection

@section('footer-scripts')
@endsection 

@section('content-top')
  @include('flash::message')
  <h1>
    Create LineItem
  </h1>
@endsection

@section('content-main')
<div class="box box-primary">
    {!! Form::open(['action' => 'LineItemController@store']) !!}
        @include('admin.lineitem.fields')  
    {!! Form::close() !!}
</div>
@endsection	


