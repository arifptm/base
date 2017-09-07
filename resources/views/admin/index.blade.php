@extends('admin.template.layout')

@section('header-scripts')
  <link rel="stylesheet" href="/bower_components/AdminLTE/plugins/iCheck/flat/purple.css">
      @if(Session::has('downloadit'))
         <meta http-equiv="refresh" content="3; url={{ Session::get('downloadit') }}">
      @endif
@endsection

@section('footer-scripts')
	<script src="/bower_components/AdminLTE/plugins/iCheck/icheck.min.js"></script>
	<script src="/js/custom.js"></script>
@endsection

@section('content-top')
      <h1>
        Dashboard
      </h1>
@endsection

@section('content-main')
Dashboard

@endsection