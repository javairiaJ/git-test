@extends('admin/admin_template')
<?php
$readonly = 'readonly';
$required = "required";
?>
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        @include('admin/commons/errors')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit {{$model->type}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::model($model, ['files' => true,'class' => 'form','url' => ['admin/content/update', $model->id], 'method' => 'post']) !!}
                <!-- text input -->
                <?php
                $type = $model->type;
                $page = 'admin.content.form' . $type;
                ?>
                @include($page)
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

@endsection