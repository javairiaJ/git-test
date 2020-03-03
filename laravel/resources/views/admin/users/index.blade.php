@extends('admin/admin_template')

@section('content')


<style>

hr{
    background-color: #87438e;
    height: 2px; border: 0;
}
</style>
    <!-- Content Header (Page header) -->
    <section class="content-header" style="color: #87438e; font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
        <h1 style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
            Users
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}" style="color:#87438e;"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
        </ol>
    </section>
    <hr>
    <!-- Main content -->
    <section class="content" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; color: #708090;">
        <div class="row" style="color: #708090;">
            <div class="col-xs-12">
                @include('admin/commons/errors')
                <div class="box">
                    <div class="box-header with-border" style="color: #cd0011;">
                        <h3 class="box-title" style="color: #cd0011;"><i class="fa fa-search"></i> Search</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <form class="form" role="form" id="filter" style="color: #708090;">
                        <div class="box-body" style="color: #708090;">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('First Name') !!}
                                        {!! Form::text('firstName',(isset($sFirstName))?$sFirstName:'', array('class' => 'form-control', 'id' => 'firstName') ) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('Last Name') !!}
                                        {!! Form::text('lastName',(isset($sLastName))?$sLastName:'', array('class' => 'form-control', 'id' => 'lastName') ) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('email') !!}
                                        {!! Form::text('email',(isset($sEmail))?$sEmail:'', array('class' => 'form-control', 'id' => 'email') ) !!}
                                    </div>
                                </div>
                            <!--                            <div class="form-group col-sm-6">
                                                            <label for="filter">Type</label>
                                                            <select class="form-control" name="status">
                                                                                                    <option value="" selected>All </option>
                                                                <option value="1" {{(isset($status) && $status == 1)?'selected':''}}>Active </option>
                                                                <option value="0" {{(isset($status) && $status == 0)?'selected':''}}>Expired / Blocked / Deactive</option>                             
                                                            </select>
                                                        </div>-->
                                <div class='clearfix'></div>
                                <input type="hidden" class="form-control" name="page" id="page"
                                       value="<?php echo $iPage; ?>"/>
                                <div class='clearfix'></div>
                                <div class="form-group col-sm-2">
                                    <button type="submit" class="btn btn-primary btn-flat btn-block" style="background-color: #cd0011; border:none;">Search</button>
                                </div>
                                <div class="form-group col-sm-2">
                                    <a href="{{ url('admin/users') }}" class="btn btn-danger btn-block btn-flat" style="background-color: #cd0011; border:none;">Clear
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
                    <div id="user_listing"></div>
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
            userListing();
        });
        $("form").submit(function (e) {
            userListing();
            e.preventDefault();

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
                url: "<?php echo url('admin/users/listing'); ?>",
                type: 'get',
                dataType: 'html',
                data: formdata,
                beforeSend: function () {
                    $('.loading').css('display', 'block');
                    $("#user_listing").css("display", "none");
                    console.log('Loading . . . .');
                },
                complete: function () {
                    $('.loading').css('display', 'none');
                    $('#user_listing').css('display', 'block');
                    console.log('complete');
                },
                success: function (response) {
                    //console.log(response);
                    $('#user_listing').html(response);
                },
                error: function (xhr, status, response) {
                }
            });
        }
    </script>
@endsection
