@extends('admin.auth_layout')
<?php
$title = 'Login';
$description = '';
$keywords = '';
?>
@include('admin/commons/meta')
@section('content')
<?php
$required = 'required';
?>
<div class="register-box">
    @include('admin/commons/errors')
    @include("admin/login_form")
</div>
<style>
    .content {
        background: #1f3b52;
    }

</style>
<script>
    $('form').submit(function () {
        $(this).find('button').prop('disabled', true);
    });
</script>
@endsection