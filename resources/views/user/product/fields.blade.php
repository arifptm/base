
<div class="box-body">
	<div class="col-md-6">					
		<div class="form-group">
			<div class="row">
				@if (\Request::route()->getName() == 'edit.product' OR \Request::route()->getName() == 'user.edit.product')
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

				
	</div>
	<div class="col-md-6">	
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


<div class="box-footer">
	<div class="form-group">
		{!! Form::submit('Simpan',  ['class' => 'btn btn-primary']) !!}
	</div>
</div>	