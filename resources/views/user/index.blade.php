@extends('template.layout')

@section('header-scripts')
  <link rel="stylesheet" href="/bower_components/AdminLTE/plugins/iCheck/flat/purple.css">
  <link rel="stylesheet" href="/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.css">
  <link rel="stylesheet" href="/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('footer-scripts')
   <script src="/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
   <script src="/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="/bower_components/AdminLTE/plugins/iCheck/icheck.min.js"></script>
	<script src="/js/custom.js"></script>

   <script>
      $(function() {
         $('#products-table').DataTable({
         processing: true,
         serverSide: true,
         responsive: true,
         autoWidth   : false,
         order: [ 0, "desc" ],
         ajax: '{!! route('products.data') !!}',
         columns: [
            { data: 'id', name: 'id' },
            { data: 'thumb', name: 'thumb',orderable: false, searchable: false },
            { data: 'title_a', name: 'name' },
            { data: 'body_limit', name: 'body',orderable: false, searchable: false },
            { data: 'stock', name: 'stock' }, 
            { data: 'action', name: 'action',orderable: false, searchable: false }
            ]
         });

         $('#myModal').on("show.bs.modal", function (e) {
            $("#datatitle").html($(e.relatedTarget).data('datatitle'));
            $("#dataimage").html($(e.relatedTarget).data('dataimage'));
            $("#dataid").attr( 'value', ($(e.relatedTarget).data('dataid')));
         });
      });
   </script>

@endsection

@section('content-top')
@include('flash::message')
@if($order_inprogress)
   <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Perhatian!</h4>
    Anda mempunyai permintaan yang belum dikirim kepada Admin.
    Silakan  <a href="/orders/{{ $order_inprogress->id }}"> klik di sini</a> untuk mengirim permintaan.
  </div>
@endif
@endsection


@section('content-main')
   <div class="row">       
      @if ($order_inprogress)<div class="col-md-8"> @else <div class="col-md-12"> @endif
         <div class="box">       
            <div class="box-header with-border">
               <h3 class="box-title">Daftar Barang </h3>
            </div>         
            <div class="box-body">
               <table class="table table-bordered" id="products-table">
                  <thead>
                     <tr>
                        <th>Id</th>
                        <th>Gambar</th>
                        <th>Nama Barang</th> 
                        <th>Catatan</th>                       
                        <th>Stok</th>
                        <th></th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
      
      @if($order_inprogress)
      <div class="col-md-4">           
            <div class="box">       
               <div class="box-header with-border">
                  <div></div>
                  <h3 class="box-title">Rencana Permintaan Barang</h3> <small>({{ $order_inprogress->created_at->format('d M Y') }})</small>
               </div>         
               <div class="box-body">
                  <table class="table table-bordered" id="products-table">
                     <thead>
                        <tr>
                           <th>Id</th>
                           <th>Nama Barang</th> 
                           <th>Qty</th>                                                  
                        </tr>
                        @foreach($order_inprogress->lineitem as $item)
                           <tr>
                              <td>
                                 {{ $item->id }}
                              </td>

                              <td>
                                 <a href="{{ $item->product->slug }}" >{{ $item->product->name }}</a>
                              </td>

                              <td>
                                 {{ $item->quantity }}
                              </td>

                           </tr>
                        @endforeach
                     </thead>
                  </table>
               </div>
               <div class="box-footer">
               <a href="/orders/{{$order_inprogress->id}}" class="btn btn-primary">Lanjutkan...</a>
               </div>
            </div>
         
      </div>
      @endif
   </div>   

   @include('user.product.modal')

@endsection