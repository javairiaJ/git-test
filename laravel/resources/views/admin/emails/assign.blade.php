@extends('admin/admin_template')
<?php
$sRequired = "required";
?>
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        @include('admin/commons/errors')
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Assign Emails</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open(array( 'class' => 'form','url' => 'admin/emails/assign', 'files' => true, 'method' => 'post')) !!}
                <div class="form-group">
                    {!! Form::label('Emails *') !!}
                    {!! Form::select('email_id', array('' => 'Select any one option') + $aEmails,null,['class' => 'form-control select2',$sRequired]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Templates *') !!}
                    {!! Form::select('template_id[]', $aTemplates,null,['class' => 'form-control select2','multiple'=>'multiple',$sRequired]) !!}
                </div>
                

                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ url('admin/modules')}}" class="btn btn-default btn-block btn-flat">Back</a>
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
    $(document).ready(function () {
        $(".select").select2();
    });
    $('form').submit(function () {
        $(this).find('button').prop('disabled', true);
    });
</script>
@endsection
