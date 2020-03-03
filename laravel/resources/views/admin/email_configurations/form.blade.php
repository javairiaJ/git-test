<?php
$sRequired = "required";
?>
<div class="form-group">
	{!! Form::label('Mail Driver *') !!}
	{!! Form::text('driver', null , array('class' => 'form-control',$sRequired) ) !!}
</div>

<div class="form-group">
	{!! Form::label('Mail Server Host *') !!}
	{!! Form::text('host', null , array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
	{!! Form::label('Mail Port *') !!}
	{!! Form::number('port', null , array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
	{!! Form::label('Mail Username *') !!}
	{!! Form::email('username', null , array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
	{!! Form::label('Mail Password *') !!}
	{!! Form::text('password', null , array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
	{!! Form::label('Mail Encryption *') !!}
	{!! Form::text('encryption', null , array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
	{!! Form::label('Mail From Name *') !!}
	{!! Form::text('from_name', null , array('class' => 'form-control',$sRequired) ) !!}
</div>