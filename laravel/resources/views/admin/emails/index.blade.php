@extends('admin/admin_template')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Emails
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Emails</li>
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('email') !!}
                                        {!! Form::text('email',(isset($sEmail))?$sEmail:'', array('class' => 'form-control', 'id' => 'email') ) !!}
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
                                    <a href="{{ url('admin/emails') }}" class="btn btn-danger btn-block btn-flat">Clear
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
                    <div id="emails_listing"></div>
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
            emailsListing();
        });
        $("form").submit(function (e) {
            emailsListing();
            e.preventDefault();

        });

        function emailsListing() {
            var formdata = $("#filter").serialize();
            $.ajax({
                url: "<?php echo url('admin/emails/listing'); ?>",
                type: 'get',
                dataType: 'html',
                data: formdata,
                beforeSend: function () {
                    $('.loading').css('display', 'block');
                    $("#emails_listing").css("display", "none");
                    console.log('Loading . . . .');
                },
                complete: function () {
                    $('.loading').css('display', 'none');
                    $('#emails_listing').css('display', 'block');
                    console.log('complete');
                },
                success: function (response) {
                    //console.log(response);
                    $('#emails_listing').html(response);
                },
                error: function (xhr, status, response) {
                }
            });
        }
    </script>
@endsection
