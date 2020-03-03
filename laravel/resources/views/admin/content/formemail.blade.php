<div class="form-group">
    {!! Form::label('title') !!}
    {!! Form::text('title', null , array('class' => 'form-control',$required) ) !!}
</div>
<div class="form-group">
    {!! Form::label('code') !!}
    {!! Form::text('code', null , array('class' => 'form-control',$readonly,$required) ) !!}
</div>
<div class="form-group">
    {!! Form::label('subject') !!}
    {!! Form::text('subject', null , array('class' => 'form-control',$required) ) !!}
</div>
<div class="form-group">
    {!! Form::label('body') !!}
    {!! Form::textarea('body', null, ['size' => '105x25','class' => 'form-control ckeditor',$required]) !!} 
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
    </div>
    <div class="form-group col-sm-6">
        <a href="{{ url('admin/content?type='.$type)}}" class="btn btn-default btn-block btn-flat">Back</a>
    </div>    
</div>
