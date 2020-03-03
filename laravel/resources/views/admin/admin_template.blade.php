<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--        <title>{{Config::get('params.site_name')}} | Admin</title>-->
    <title>{{Config::get('constants.site_name')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="{{asset('front/images/favicon.png')}}">
    <!-- Bootstrap 3.3.5 -->
    <link href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- <link rel="stylesheet" href="{{ asset('adminlte/style.css')}}"> -->


    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datepicker/datepicker3.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="{{ asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/ckeditor/ckeditor.js')}}"></script>
    <style>
        .loading {
            background: url({{ asset('front/images/loader.gif') }}) no-repeat scroll center center #d2d6dea3;
height: 100%;
left: 110px;
position: fixed;
top: 0;
width: 100%;
z-index: 101;
}
.fixed .content-wrapper,
.fixed .right-side {
    padding-top: 8px;
}
</style>
</head>
<body class="sidebar-mini fixed skin-black ">
    <div class="wrapper" style="background-color: #fff;">


        <!-- Header -->
        @include('admin/commons/header')

        <!-- Sidebar -->
        @include('admin/commons/sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #fff;">
            <div class="loading" style="display: none">
                <img src="{{ asset('front/images/loader.gif') }}">
            </div>

            <section class="content">
                <!-- Your Page Content Here -->
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Footer -->
        @include('admin/commons/footer')
    </div>
    <script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{ asset('adminlte/dist/js/app.min.js')}}"></script>

    <script>

        $(document).ready(function () {
         $('.select2').select2({
            allowClear:true,
            placeholder: function(){
                $(this).data('placeholder');
            }
        }
        );
         var url = window.location;
         $('.sidebar-menu a[href="' + url + '"]').parent().addClass('active');

         $('.sidebar-menu a[href="' + url + '"]').closest('.treeview').addClass('active');

         $('.sidebar-menu a[href="' + url + '"]').closest('.treeview-menu').css("display", "block");

         $('.sidebar-menu a').filter(function () {
            return this.href === url;
        }).parent().addClass('active');


     });

    //$(function () {
    //    $('input').iCheck({
    //        checkboxClass: 'icheckbox_square-blue',
    //        radioClass: 'iradio_square-blue',
    //        increaseArea: '20%' // optional
    //    });
    //});
</script>
</body>
</html>
