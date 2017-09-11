
<div class="box-body">
	<div class="row">
		<div class="col-md-6">					
			<div class="form-group">
				<div class="box box-solid bg-green-gradient" >
					<div class="box-body">
						<div class="icheck">
							{!! Form::radio('verified', 0, null,['class'=>'pending']) !!}
							{!! Form::label('verified', 'Pending',['class'=>'control-label', 'style'=>'margin-right:40px;']) !!}  

							{!! Form::radio('verified', 1, null,['class'=>'approve']) !!}
							{!! Form::label('verified', 'Terima',['class'=>'control-label', 'style'=>'margin-right:40px;']) !!}             

							{!! Form::radio('verified', 9, null,['class'=>'reject']) !!}
							{!! Form::label('verified', 'Tolak',['class'=>'control-label']) !!}             
						</div>
					</div>
				</div>
			</div>

			<div id="leftpanel" @if( $product->verified != 1) class="hidden"  @endif>
				<div class="form-group">
					<div class="row">
						@if (\Request::route()->getName() == 'edit.product' )
							@if ($product->image != null )
								<div class="col-md-4">
									<img src="/assets/products/{{ $product->image }}" alt="" height="100" />
								</div>
							@endif	
						@endif	
						<div class="col-md-8">
							{!! Form::label('image', 'Gambar', ['class'=>'control-label']) !!}
							{!! Form::file('image', null, ['class' => 'form-control']) !!}
							@if ($errors->has('image'))
							    <div class="label label-danger">
							        {{ $errors->first('image') }}
							    </div>
							@endif
						</div>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('name', 'Nama Barang', ['class'=>'control-label']) !!}
					{!! Form::text('name', null, ['class' => 'form-control']) !!}
					@if ($errors->has('name'))
					    <div class="label label-danger">
					        {{ $errors->first('name') }}
					    </div>
					@endif
				</div>	
				<div class="form-group">
					{!! Form::label('price', 'Perkiraan harga', ['class'=>'control-label']) !!}
					{!! Form::number('price', null, ['class' => 'form-control']) !!}
					@if ($errors->has('price'))
					    <div class="label label-danger">
					        {{ $errors->first('price') }}
					    </div>
					@endif
				</div>
				<div class="form-group">
					{!! Form::label('url', 'URL Referensi', ['class'=>'control-label']) !!}
					{!! Form::url('url', null, ['class' => 'form-control']) !!}
					@if ($errors->has('url'))
					    <div class="label label-danger">
					        {{ $errors->first('url') }}
					    </div>
					@endif
				</div>
			</div>
					
		</div>
		<div class="col-md-6">	
			<div id="rightpanel"  @if( $product->verified != 1) class="hidden"  @endif>
				<div class="form-group">  
				    <div class="icheck">
				        {!! Form::checkbox('disposable') !!} 
				        {!! Form::label('disposable', 'Barang habis pakai? ? ',['class'=>'control-label']) !!}             
				    </div>
				</div>
				<div class="form-group">
					{!! Form::label('register_date', 'Tanggal masuk', ['class'=>'control-label']) !!}
					{!! Form::date('register_date', null, ['class' => 'form-control']) !!}
					@if ($errors->has('register_date'))
					    <div class="label label-danger">
					        {{ $errors->first('register_date') }}
					    </div>
					@endif
				</div>			
				<div class="form-group">
					{!! Form::label('stock', 'Persediaan/stock', ['class'=>'control-label']) !!}
					{!! Form::number('stock', null, ['class' => 'form-control']) !!}
					@if ($errors->has('stock'))
					    <div class="label label-danger">
					        {{ $errors->first('stock') }}
					    </div>
					@endif
				</div>	
				<div class="form-group">
					{!! Form::label('placement', 'Penempatan', ['class'=>'control-label']) !!}
					{!! Form::text('placement', null, ['class' => 'form-control']) !!}
					@if ($errors->has('placement'))
					    <div class="label label-danger">
					        {{ $errors->first('placement') }}
					    </div>
					@endif
				</div>		
				<div class="form-group">
					{!! Form::label('body', 'Keterangan', ['class'=>'control-label']) !!}
					{!! Form::textarea('body', null, ['class' => 'form-control','rows'=>'3']) !!}
					@if ($errors->has('body'))
					    <div class="label label-danger">
					        {{ $errors->first('body') }}
					    </div>
					@endif
				</div>			
			</div>
		</div>
	</div>
</div>
		
<div class="box-footer">
	<div class="form-group">
		{!! Form::submit('Simpan',  ['class' => 'btn btn-primary btn-lg']) !!}
	</div>
</div>	
		