<?php
$sRequired = "required";
?>
<div class="form-group">
    {!! Form::label('First Name *') !!}
    {!! Form::text('firstName', null, array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
    {!! Form::label('Last Name *') !!}
    {!! Form::text('lastName', null , array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
    {!! Form::label('Email *') !!}
    {!! Form::text('email', null , array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
    {!! Form::label('Designation *') !!}
    {!! Form::text('designation', null , array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
    {!! Form::label('Role *') !!}
    {!! Form::select('role_id', array('' => 'Please select one option') + $aRoles,null,['class' => 'form-control select2',$sRequired]) !!}
</div>
<div class="form-group">
    {!! Form::label('Templates *') !!}
    {!! Form::select('template_id[]', $aTemplates, $oUserTemplate,['class' => 'form-control select2','data-placeholder' => 'Please select one option','multiple'=>'multiple',$sRequired]) !!}
</div>

