@extends('admin/admin_template')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Content Pages
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Content Pages</li>
    </ol>
</section>
<!-- Main content -->
<section class="content" style="background-color: #fff;">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            @include('admin/commons/errors')
            <!-- PRODUCT LIST -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">( Total : {{ count($model) }} ) </h3>

<!--                    <div class="box-tools pull-right">
                        <a class="btn btn-primary btn-flat" href="{{url('admin/content/create')}}?type=<?php echo $type; ?>">Create new <?php echo $type; ?> template</a>
                    </div>-->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php if (count($model) > 0) { ?>
                    <ul class="products-list product-list-in-box">
                        <table class="table" id="order_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Page Code</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($model as $row)
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
<!--                                        <a href="{{ url($row->code) }}" target="_blank">-->
                                            <?php echo $row->title; ?>
<!--                                        </a>-->
                                    </td>
                                    <td><?php echo $row->code; ?></td>
                                    <td>
                                        <?php
                                        if ($row->status == '1') {
                                        echo '<span class="badge"><i class="fa fa-check-circle-o"></i> Active</span>';
                                        } else {
                                        echo '<span class="badge"><i class="fa fa-warning"></i> Expired</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/content/edit/'.$row->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                        <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#myModal" data-link="{{ URL('admin/content/delete/'.$row->id) }}"><i class="fa fa-trash"></i> </button>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                @include('admin/commons/delete_modal')
                            </tbody>
                        </table>
                        <?php echo $model->appends(Input::query())->render(); ?>
                    </ul>
                    <?php } else {
                        ?>
                        <div class="">
                            No Data found. . .
                        </div>
                    </div>
                <?php }
                ?>
            </div>
            <!-- /.box-body -->
        </div>
    <!-- /.col -->
</div>
<!-- /.row -->	
</section>
<script>
    jQuery('.delete').click(function ()
    {
        $('#closemodal').attr('href', $(this).data('link'));
    });
</script>
@endsection