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
                <h3 class="box-title">Edit User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::model($oUser, ['files' => true,'class' => 'form','url' => ['admin/user/update', $oUser->id], 'method' => 'post']) !!}

                <!-- text input -->           
                @include('admin.users.form')

                <div class="row">
                    <div class="col-sm-6">
                        <input type="hidden" name="id" value="{{ $oUser->id }}">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" style="color: #800000;">Save</button>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ url('admin/users')}}" class="btn btn-default btn-block btn-flat" style="color: #800000;">Back</a>
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
