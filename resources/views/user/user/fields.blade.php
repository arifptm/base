
<div class="box-body">
	<div class="form-group">
		{!! Form::label('name', 'Name', ['class'=>'control-label']) !!}
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
		@if ($errors->has('name'))
		    <div class="label label-danger">
		        {{ $errors->first('name') }}
		    </div>
		@endif
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Email',['class'=>'control-label']) !!}
		{!! Form::text('email', null, ['class' => 'form-control']) !!}
		@if ($errors->has('email'))
		    <div class="label label-danger">
		        {{ $errors->first('email') }}
		    </div>
		@endif
	</div>
	<div class="form-group">  
	    <div class="icheck">
	        {!! Form::checkbox('verified') !!} 
	        {!! Form::label('verified', 'verified ? ',['class'=>'control-label']) !!}             
	    </div>
	</div>

</div>

<div class="box-footer">
	<div class="form-group">
		{!! Form::submit('Simpan',  ['class' => 'btn btn-primary']) !!}
	</div>
</div>	