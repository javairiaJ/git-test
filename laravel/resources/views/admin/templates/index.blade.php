@extends('admin/admin_template')

@section('content')
<style>

hr{
    background-color: #87438e;
    height: 2px; border: 0;
}
</style>
    <!-- Content Header (Page header) -->
    <section class="content-header" style="color: #87438e; ">
        <h1 style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
            Templates
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard" style="color: #87438e;"></i> Home</a></li>
            <li class="active">Templates</li>
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
                        <h3 class="box-title" style="color: #cd0011; "><i class="fa fa-search" ></i> Search</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" ><i
                                        class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <form class="form" role="form" id="filter">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group" style="color: #708090;">
                                        {!! Form::label('Title') !!}
                                        {!! Form::text('title',(isset($title))?$title:'', array('class' => 'form-control', 'id' => 'title') ) !!}
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
                                    <button type="submit" class="btn btn-primary btn-flat btn-block" style="background-color:  #cd0011; border: none;">Search</button>
                                </div>
                                <div class="form-group col-sm-2">
                                    <a href="{{ url('admin/templates') }}" class="btn btn-danger btn-block btn-flat"  style="background-color: #cd0011;  border: none;">Clear
                                        Search</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row" style="color: #696969">
            <!-- Left col -->
            <div class="col-md-12 col-xs-12" style="color: #696969 ">
                <div class="box box-default" style="color: #696969">
                    <div id="templates_listing" style="color: #708090;"></div>
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
            templateListing();
        });
        $("form").submit(function (e) {
            templateListing();
            e.preventDefault();

        });
        //    $("form").change(function (e) {
        //        userListing();
        //        e.preventDefault();
        //    });
        //    $("#firstName, #lastName, #email").keyup(function (e) {
        //        userListing();
        //    });

        function templateListing() {
            var formdata = $("#filter").serialize();
            $.ajax({
                url: "<?php echo url('admin/templates/listing'); ?>",
                type: 'get',
                dataType: 'html',
                data: formdata,
                beforeSend: function () {
                    $('.loading').css('display', 'block');
                    $("#templates_listing").css("display", "none");
                    console.log('Loading . . . .');
                },
                complete: function () {
                    $('.loading').css('display', 'none');
                    $('#templates_listing').css('display', 'block');
                    console.log('complete');
                },
                success: function (response) {
                    //console.log(response);
                    $('#templates_listing').html(response);
                },
                error: function (xhr, status, response) {
                }
            });
        }
    </script>
@endsection
