@extends('admin/admin_template')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $oTemplate->title }}
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/templates') }}"><i class="fa fa-dashboard"></i> Templates</a></li>
        <li class="active">{{ $oTemplate->title }}</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
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
