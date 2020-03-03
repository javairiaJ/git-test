@extends('admin/admin_template')
@section('content')


<style>

hr{
    background-color: #87438e;
    height: 1px; border: 0;
}
</style>

<!-- Content Header (Page header) -->
<section class="content-header" style="color: #87438e; font-family: font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
    <h1 style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
        {{ $oTemplate->title }}
       </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/templates') }}"><i class="fa fa-dashboard"></i> Templates</a></li>
        <li class="active" style="color: #87438e;">{{ $oTemplate->title }}</li>
    </ol>
</section>
<hr>
<!-- Main content -->
<section class="content" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
    <div class="row" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
        @include('admin/commons/errors')


        {!! Form::open(array( 'class' => 'form','url' => 'admin/templates/details/insert/'.$oTemplate->code, 'files' => true)) !!}

        @include('admin.templates.forms.' .$oTemplate->code)
        <input type="hidden" name="template_id" value="{{ $oTemplate->id }}">

        {!! Form::close() !!}

    </div>
</section>
<script>
    $(document).ready(function () {
        $(".select").select2();
    });
    $('form').submit(function () {
        $(this).find('button').prop('disabled', true);
    });
</script>
@endsection
