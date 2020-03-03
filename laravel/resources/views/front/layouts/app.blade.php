<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('constants.site_name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">        
    <link rel="stylesheet" href="{{ asset('front/css/app.css') }}">
    <link rel="stylesheet" href="{{asset('front/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/extralized/bootstrap-datetimepicker.css')}}"/>
    <link rel="stylesheet" href="{{asset('front/css/dropdown.css')}}"/>
    <script src="{{asset('/front/js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('/front/extralized/bootstrap-datepicker.js')}}"></script>
    
     <!-- <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

</head>
<body>

    <div id="app">
        @include('front/commons/navigation')

        @yield('content')
    </div>

    <!-- Scripts -->
    <!--        <script src="{{ asset('front/js/app.js') }}"></script>-->
    <script src="{{asset('/front/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('/front/js/dropdown.js')}}"></script>
    <script src="{{asset('/front/js/viewportchecker.js')}}"></script>
    <script src="{{asset('/front/js/kodeized.js')}}"></script>
    @include('front/commons/js')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            unseenNotifications();
        });
    </script>

</body>
</html>
