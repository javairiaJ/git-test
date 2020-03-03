@extends('admin/admin_template')
@section('content')
<style>
    .user-detail-image img {
        height: 260px;
        width: 100%;
    }
</style>
<div class="row">
    <div class="col-md-12">
        @include('admin/commons/errors')
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">Module Information </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>

                </div>
            </div>
            <div class="box-body bg-success">
                <div class="row">
                    <div class="col-sm-9">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Title :</td>
                                    <td>{{ $oModule->title }}</td>
                                </tr>
                                <tr>
                                    <td>Path :</td>
                                    <td>{{ $oModule->path }}</td>
                                </tr>
                                <tr>
                                    <td>Created :</td>
                                    <td>{{ date("d M Y", strtotime($oModule->created_at)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a class="btn btn-default" href="{{ url('admin/modules') }}"> Back </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-7">
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">( Total Sub Modules : {{ count($aSubModules) }} )</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button> 
                </div>
            </div>

            <div class="box-body">
                <?php if (count($aSubModules) > 0) { ?>
                    <table class="table" id="order_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Path</th>
                                <th>Parent</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($aSubModules as $row)
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row->title; ?></td>
                                <td><?php echo $row->path; ?></td>
                                <td><?php echo $oModule->title; ?></td>
                                <td><?php echo date("d M Y", strtotime($row->created_at)); ?></td>
                                <?php
                                if ($row->status == 1) {
                                    $sStatus = 'success';
                                    $sText = 'Active';
                                } else {
                                    $sStatus = 'danger';
                                    $sText = 'Expired / Blocked / Deactive';
                                }
                                ?>
                                <td><span class="label label-{{$sStatus}}">{{$sText}}</span></td>
                                <td>
                                    <a href="{{ url('admin/module/edit/'.$row->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#myModal" data-link="<?php echo url('admin/module/delete/' . $row->id); ?>"><i class="fa fa-trash"></i> </button>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                            @include('admin/commons/delete_modal')
                        </tbody>

                    </table>
                    <?php //echo $aSubModules->links(); ?>

                <?php } else { ?>
                    <div class="">
                        No Data found. . .
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>

    <div class="col-md-5">
        <div class="box box-default">

            <div class="box-header with-border">
                <h3 class="box-title">( Total Assigned Users : {{ count($aUserModules) }} )</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button> 
                </div>
            </div>

            <div class="box-body">
                <?php if (count($aUserModules) > 0) { ?>
                    <table class="table" id="order_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($aUserModules as $row)
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row->name; ?></td>
                                <td><?php echo date("d M Y", strtotime($row->created_at)); ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#myModal" data-link="user/delete/<?php echo $row->user_modules_id ?>"><i class="fa fa-trash"></i> </button>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                            @include('admin/commons/delete_modal')
                        </tbody>

                    </table>
                    <?php //echo $aSubModules->links(); ?>

                <?php } else { ?>
                    <div class="">
                        No Data found. . .
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>


</div>


<script>
    jQuery('.delete').click(function ()
    {
        $('#closemodal').attr('href', $(this).data('link'));
    });
</script>
@endsection
