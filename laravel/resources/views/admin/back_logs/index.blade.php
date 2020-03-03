@extends('admin/admin_template')
<?php
$currentMonth = date('m');
$currentYear = date('Y');
?>
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Back Logs
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Back Logs</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row" >
        <div class="col-xs-12">
            @include('admin/commons/errors')            
        </div>
    </div>
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12 col-xs-12">

            <div class="box box-default" id="backLogs_listing">

            </div>

        </div>
    </div>
</section>
<script>
    jQuery('.delete').click(function ()
    {
        $('#closemodal').attr('href', $(this).data('link'));
    });
</script>
<script>
    $(document).ready(function () {
        userListing();
    });
    $(".submitSearch").on('click', function () {
        userListing();
    });
//    $("form").change(function (e) {
//        userListing();
//        e.preventDefault();
//    });
//    $("#firstName, #lastName, #email").keyup(function (e) {
//        userListing();
//    });

    function userListing() {
        var formdata = $("#filter").serialize();
        $.ajax({
            url: "<?php echo url('admin/back-logs/listing'); ?>",
            type: 'get',
            dataType: 'html',
            data: formdata,
            beforeSend: function () {
                $('#loading').css('display', 'block');
                // $('#submit').css('display', 'none');
                console.log('Loading . . . .');
            },
            complete: function () {
                $('#loading').css('display', 'none');
                // $('#submit').css('display', 'block');
                console.log('complete');
            },
            success: function (response) {
                $('#backLogs_listing').html(response);
            },
            error: function (xhr, status, response) {
            }
        });
    }
</script>
@endsection
