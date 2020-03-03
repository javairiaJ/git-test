@extends('admin/admin_template')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Modules
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Modules</li>
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
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>   
                    </div>
                </div>

                <form class="form" role="form" id="filter">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('Title') !!}
                                    {!! Form::text('title',(isset($sTitle))?$sTitle:'', array('class' => 'form-control', 'id' => 'title') ) !!}
                                </div>
                            </div>
                            <div class='clearfix'></div>
                            <input type="hidden" class="form-control" name="page" id="page" value="<?php echo $iPage; ?>"/>
                            <div class='clearfix'></div>
                            <div class="form-group col-sm-2">
                                <button type="submit" class="btn btn-primary btn-flat btn-block">Search</button>
                            </div>
                            <div class="form-group col-sm-2">
                                <a href="{{ url('admin/modules') }}" class="btn btn-danger btn-block btn-flat">Clear Search</a>
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
                <div id="module_listing"></div>
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
        moduleListing();
    });
    $("form").submit(function (e) {
        moduleListing();
        e.preventDefault();

    });
//    $("form").change(function (e) {
//        userListing();
//        e.preventDefault();
//    });
//    $("#firstName, #lastName, #email").keyup(function (e) {
//        userListing();
//    });

    function moduleListing() {
        var formdata = $("#filter").serialize();
        $.ajax({
            url: "<?php echo url('admin/modules/listing'); ?>",
            type: 'get',
            dataType: 'html',
            data: formdata,
            beforeSend: function () {
                $('.loading').css('display', 'block');
                $("#module_listing").css("display", "none");
                console.log('Loading . . . .');
            },
            complete: function () {
                $('.loading').css('display', 'none');
                $('#module_listing').css('display', 'block');
                console.log('complete');
            },
            success: function (response) {
                //console.log(response);
                $('#module_listing').html(response);
            },
            error: function (xhr, status, response) {
            }
        });
    }
</script>
@endsection
