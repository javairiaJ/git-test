<?php
$required = "required";
$languages = Config::get('params.languages');
$types = Config::get('params.contentTypes');
?>
@include('admin/commons/errors')

<div class="form-group">
    {!! Form::label('title') !!}
    {!! Form::text('title', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('code') !!}
    {!! Form::text('code', null , array('class' => 'form-control',$required) ) !!}
</div>

<div class="form-group">
    {!! Form::label('body') !!}
    {!! Form::textarea('body', null, ['size' => '105x25','class' => 'form-control ckeditor',$required]) !!} 
</div>


<div class="form-group">
    {!! Form::label('teaser') !!}
    {!! Form::textarea('teaser', null, ['size' => '105x3','class' => 'form-control']) !!} 
</div>
<!--
<div class="form-group">
    {!! Form::label('url') !!}
    {!! Form::text('url', null , array('class' => 'form-control',$required) ) !!}
</div>
-->
<div class="form-group">
    {!! Form::label('Meta Title') !!}
    {!! Form::text('metaTitle', null , array('class' => 'form-control') ) !!}
</div>

<div class="form-group">
    {!! Form::label('Meta Description') !!}
    {!! Form::textarea('metaDescription', null, ['size' => '105x3','class' => 'form-control']) !!} 
</div>
<div class="form-group">
    {!! Form::label('keywords') !!}
    {!! Form::text('keywords', null , array('class' => 'form-control') ) !!}
</div>
<!--
<div class="form-group">
    {!! Form::label('Banner') !!}
    {!! Form::file('image', null,array($required,'class'=>'form-control')) !!}
</div>
-->
<div class="form-group col-sm-6">
    <button type="submit" class="btn btn-primary btn-block btn-flat" style="background-color: #800000;">Save</button>
</div>
<div class="form-group col-sm-6">
    <a href="{{ url('admin/content?type=page') }}" class="btn btn-danger btn-block btn-flat" style="background-color: #800000;">Cancel</a>
</div>
