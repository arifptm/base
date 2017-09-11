
<div class="box-body">
	<div class="col-md-6">					
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
	<div class="col-md-6">	
		<div class="form-group">  
		    <div class="icheck">
		        {!! Form::checkbox('verified') !!} 
		        {!! Form::label('verified', 'Terverifikasi ? ',['class'=>'control-label']) !!}             
		    </div>
		</div>

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
		
	</div>
</div>


<div class="box-footer">
	<div class="form-group">
		{!! Form::hidden('user_id', Auth::user()->id ) !!}
		{!! Form::hidden('slug', 'metal' ) !!}
		{!! Form::submit('Simpan',  ['class' => 'btn btn-primary']) !!}
	</div>
</div>	