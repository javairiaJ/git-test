@section('title')<?php echo isset($title) ? $title : 'Page Title'; ?>@stop
@section('description')<?php echo isset($description) ? $description : 'Page Description'; ?>@stop
@section('keywords')<?php echo isset($keywords) ? $keywords : ''; ?>@stop
@section('apple-mobile-web-app-capable')<?php echo isset($appleMobileWebAppCapable) ? $appleMobileWebAppCapable : 'yes'; ?>@stop
@section('apple-mobile-web-app-status-bar-style')<?php echo isset($appleMobileWebAppCapable) ? $appleMobileWebAppCapable : 'black'; ?>@stop





