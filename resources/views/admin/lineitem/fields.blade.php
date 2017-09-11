
<div class="box-body">
	<div class="col-md-6">					


		<div class="form-group">
			{!! Form::label('product_id', 'Nama Barang', ['class'=>'control-label']) !!}
			{!! Form::select('product_id', $products , null, ['class' => 'form-control']) !!}
			@if ($errors->has('product_id'))
			    <div class="label label-danger">
			        {{ $errors->first('product_id') }}
			    </div>
			@endif
		</div>	
		<div class="form-group">
			{!! Form::label('quantity', 'Jumlah', ['class'=>'control-label']) !!}
			{!! Form::number('quantity', null, ['class' => 'form-control']) !!}
			@if ($errors->has('quantity'))
			    <div class="label label-danger">
			        {{ $errors->first('quantity') }}
			    </div>
			@endif
		</div>
	</div>
</div>


<div class="box-footer">
	<div class="form-group">
		{!! Form::hidden('user_id', Auth::user()->id ) !!}
		{!! Form::hidden('slug', 'metal' ) !!}
		{!! Form::submit('Simpan',  ['class' => 'btn btn-primary']) !!}
	</div>
</div>	