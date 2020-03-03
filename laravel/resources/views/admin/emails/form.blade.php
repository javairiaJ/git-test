<?php
$sRequired = "required";
?>
<div class="form-group">
    {!! Form::label('Email *') !!}
    {!! Form::email('email', null , array('class' => 'form-control',$sRequired) ) !!}
    {!! Form::hidden('user_id', Auth::user()->id , array('class' => 'form-control',$sRequired) ) !!}
</div>

