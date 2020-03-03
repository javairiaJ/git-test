@extends('admin/admin_template')

@section('content')


<style>
    .skin-black .sidebar-menu>li:hover>a, .skin-black .sidebar-menu>li.active>a {
    color: #fff;
    background: gainsboro!important;
    border-left-color: #fff !important;
}
hr{
    background-color: #87438e;
    height: 2px; border: 0;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; color: #87438e;">
    <h1 style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
        Notifications
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}" style="color: #87438e;"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Notifications</li>
    </ol>
</section>
<hr>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            @include('admin/commons/errors')
            <div class="box">
                <div class="box-header with-border" style="color: #cd0011;">
                    <h3 class="box-title"><i class="fa fa-search" style="color: #cd0011;"></i> Search</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                            class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <form class="form" role="form" id="filter" style="color: #708090;" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group" style="color: #708090;">
                                        {!! Form::label('Title') !!}
                                        {!! Form::text('description',(isset($description))?$description:'', array('class' => 'form-control', 'id' => 'description') ) !!}
                                    </div>
                                </div>

                                <div class='clearfix'></div>
                                <input type="hidden" class="form-control" name="page" id="page"
                                value="<?php echo $iPage; ?>"/>
                                <div class='clearfix'></div>
                                <div class="form-group col-sm-2">
                                    <button type="submit" class="btn btn-primary btn-flat btn-block" style="background-color:  #cd0011; border: none;">Search</button>
                                </div>
                                <div class="form-group col-sm-2">
                                    <a href="{{ url('admin/notifications') }}" class="btn btn-danger btn-block btn-flat" style="background-color:  #cd0011; border: none;">Clear
                                    Search</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row" style="color: #708090;">
            <!-- Left col -->
            <div class="col-md-12 col-xs-12">
                <div class="box box-default">
                    <div id="notification_listing"></div>
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
            notificationsListing();
        });
        $("form").submit(function (e) {
            notificationsListing();
            e.preventDefault();

        });

        function notificationsListing() {
            var formdata = $("#filter").serialize();
            $.ajax({
                url: "<?php echo url('admin/notifications/listing'); ?>",
                type: 'get',
                dataType: 'html',
                data: formdata,
                beforeSend: function () {
                    $('.loading').css('display', 'block');
                    $("#notification_listing").css("display", "none");
                    console.log('Loading . . . .');
                },
                complete: function () {
                    $('.loading').css('display', 'none');
                    $('#notification_listing').css('display', 'block');
                    console.log('complete');
                },
                success: function (response) {
                    //console.log(response);
                    $('#notification_listing').html(response);
                },
                error: function (xhr, status, response) {
                }
            });
        }
    </script>
    @endsection
