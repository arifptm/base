   <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            {!! Form::open(['route' => 'user.store.lineitem']) !!}
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Permintaan baru</h4>
               </div>
               <div class="modal-body">
                  <section class="content-header">
                     <h1 id="datatitle"></h1>
                  </section>

                  <div class="content">
                     
                     <div class="box box-primary">
                        <div class="box-body">
                           <div class="row">
                              <div class="form-group col-sm-6">
                                 {!! Form::label('quantity', 'Jumlah permintaan:') !!}
                                 {!! Form::text('quantity', null, ['class' => 'form-control', 'required']) !!}   
                                 {!! Form::hidden('product_id', '', ['id'=> 'dataid']) !!}
                              </div>   
                              <div class="form-group col-sm-6">
                                 <span id="dataimage"></span>
                              </div>                
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  {!! Form::button('Tambahkan ke daftar permintaan',  ['type' => 'submit', 'class' => 'btn btn-primary pull-left']) !!} 
                  {!! Form::button('Batal', ['data-dismiss'=> 'modal', 'class' => 'btn btn-default']) !!}
               </div>
            {!! Form::close() !!}
         </div>
      </div>
   </div>