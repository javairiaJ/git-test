<?php
$sRequired = "required";
?>
<div class="form-group">
    {!! Form::label('Parent Module *') !!}
    {!! Form::select('parent_id', array('0' => 'Parent') + $aModules,null,['class' => 'form-control select2',$sRequired]) !!}
</div>
<div class="form-group">
    {!! Form::label('Title *') !!}
    {!! Form::text('title', null, array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
    {!! Form::label('Path *') !!}
    {!! Form::text('path', null , array('class' => 'form-control',$sRequired) ) !!}
</div>
<div class="form-group">
    {!! Form::label('Icon') !!}
    {!! Form::text('icon', null , array('class' => 'form-control') ) !!}
    <p>Add class for i tag e.g "fa fa-user"</p>
</div>

