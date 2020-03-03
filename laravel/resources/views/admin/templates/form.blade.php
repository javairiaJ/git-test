<?php
$sRequired = "required";
?>
<div class="form-group">
    {!! Form::label('Title *') !!}
    {!! Form::text('title', null, array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
    {!! Form::label('Code *') !!}
    {!! Form::text('code', null, array('class' => 'form-control',$sRequired) ) !!}
</div>

