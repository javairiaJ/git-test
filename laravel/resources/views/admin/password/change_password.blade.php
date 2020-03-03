@extends('admin/admin_template')
@section('content')
<?php
$required = 'required';
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        @include('admin/commons/errors')
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Change Password</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open(array( 'class' => 'form','url' => 'admin/password/update', 'files' => true)) !!}

                <div class="form-group">
                    {!! Form::label('Current Password') !!}
                    {!! Form::password('currentPassword', ['class'=>'form-control','placeholder'=>'Current Password',$required]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('New Password') !!}
                    {!! Form::password('password', ['class'=>'form-control','placeholder'=>'New Password',$required]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Confirm Password') !!}
                     {!! Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Confirm Password',$required]) !!}
                </div>
                <div class="row">
                    <div class="col-sm-6">                        
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ url('admin/dashboard')}}" class="btn btn-default btn-block btn-flat">Back</a>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<script>
    $('form').submit(function () {
        $(this).find('button').prop('disabled', true);
    });
</script>
@endsection