@extends('public.template.layout')

@section('header-scripts')
@endsection

@section('bottom-scripts')
@endsection

@section('content-top')
  <h1>
    Fixed Layout
    <small>Blank example to the fixed layout</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Layout</a></li>
    <li class="active">Fixed</li>
@endsection

@section('content-main')
 	<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Title</h3>
    </div>
    <div class="box-body">
    	Body
    </div>
    <div class="box-footer clearfix">
    	Footer
    </div>
  </div>
@endsection