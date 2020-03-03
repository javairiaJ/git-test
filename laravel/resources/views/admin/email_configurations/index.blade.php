@extends('admin/admin_template')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Email Configurations
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Email Configurations</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('admin/commons/errors')
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Search</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <form class="form" role="form" id="filter">
                        <div class="box-body">
                            <div class="row">
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('Mail Server Host') !!}
                                        {!! Form::text('host',(isset($sHost))?$sHost:'', array('class' => 'form-control', 'id' => 'host') ) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('Mail Username') !!}
                                        {!! Form::email('username',(isset($sUsername))?$sUsername:'', array('class' => 'form-control', 'id' => 'username') ) !!}
                                    </div>
                                </div>
                               
                                <div class='clearfix'></div>
                                <input type="hidden" class="form-control" name="page" id="page"
                                       value="<?php echo $iPage; ?>"/>
                                <div class='clearfix'></div>
                                <div class="form-group col-sm-2">
                                    <button type="submit" class="btn btn-primary btn-flat btn-block">Search</button>
                                </div>
                                <div class="form-group col-sm-2">
                                    <a href="{{ url('admin/email-configurations') }}" class="btn btn-danger btn-block btn-flat">Clear
                                        Search</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Left col -->
            <div class="col-md-12 col-xs-12">
                <div class="box box-default">
                    <div id="email_configurations_listing"></div>
                </div>
            </div>
        </div>
    </section>
    <script>
        jQuery('.delete').click(function () {
            $('#closemodal').attr('href', $(this).data('link'));
        });
    </script>
    <script>
        $(document).ready(function () {
            emailConfigurationsListing();
        });
        $("form").submit(function (e) {
            emailConfigurationsListing();
            e.preventDefault();

        });

        function emailConfigurationsListing() {
            var formdata = $("#filter").serialize();
            $.ajax({
                url: "<?php echo url('admin/email-configurations/listing'); ?>",
                type: 'get',
                dataType: 'html',
                data: formdata,
                beforeSend: function () {
                    $('.loading').css('display', 'block');
                    $("#email_configurations_listing").css("display", "none");
                    console.log('Loading . . . .');
                },
                complete: function () {
                    $('.loading').css('display', 'none');
                    $('#email_configurations_listing').css('display', 'block');
                    console.log('complete');
                },
                success: function (response) {
                    //console.log(response);
                    $('#email_configurations_listing').html(response);
                },
                error: function (xhr, status, response) {
                }
            });
        }
    </script>
@endsection
