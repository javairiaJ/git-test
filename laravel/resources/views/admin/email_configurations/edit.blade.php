@extends('admin/admin_template')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        @include('admin/commons/errors')    
        <!-- /.box -->
        <!-- general form elements disabled -->
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">Edit Email Configuration</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::model($oEmailConfiguration, ['files' => true,'class' => 'form','url' => ['admin/email-configurations/update', $oEmailConfiguration->id], 'method' => 'post']) !!}

                <!-- text input -->           
                @include('admin.email_configurations.form')

                <div class="row">
                    <div class="col-sm-6">
                        <input type="hidden" name="id" value="{{ $oEmailConfiguration->id }}">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ url('admin/email-configurations')}}" class="btn btn-default btn-block btn-flat">Back</a>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $(".select").select2();
                    });
                </script>
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
