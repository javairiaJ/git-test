<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{Config::get('constants.site_name')}} | @yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" type="image/png" href="{{asset('front/images/favicon.png')}}">
        <!-- Bootstrap 3.3.5 -->
        <link href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{ asset('adminlte/style.css')}}">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css')}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="{{ asset('adminlte/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
        <script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js')}}"></script>
    </head>
    <body class="hold-transition login-page">

        <div class="wrapper">
            @if(isset(Auth::user()->id))
            @include('front/common/header')
            @endif
            <section class="content">
                @yield('content')
            </section>
        </div>


        <script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>

        <script>
$(function () {
    $('input').iCheck({

        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
        </script>
    </body>
</html>
