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

            <div class="box-header with-border" style="color: #708090;">
                <h3 class="box-title">Template Information </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>

                </div>
            </div>
            <div class="box-body bg-success" style="color: #80000;">
                <div class="row">
                    <div class="col-sm-9">
                        <table class="table table-bordered" style="color: #80000;">
                            <tbody>
                                <tr>
                                    <td>Title :</td>
                                    <td style="font-color:  #E78E0A;">{{ $oTemplate->title }}</td>
                                </tr>
                                <tr>
                                    <td>Code :</td>
                                    <td >{{ $oTemplate->code }}</td>
                                </tr>
                                <tr>
                                    <td>Created :</td>
                                    <td>{{ date("d M Y", strtotime($oTemplate->created_at)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a class="btn btn-default" href="{{ url('admin/templates') }}"> Back </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="box box-default">

            <div class="box-header with-border" style="color: #708090;">
                <h3 class="box-title">( Total Assigned Roles : {{ count($aUserTemplates) }} )</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button> 
                </div>
            </div>

            <div class="box-body">
                <?php if (count($aUserTemplates) > 0) { ?>
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
                            @foreach ($aUserTemplates as $row)
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row->name; ?></td>
                                <td><?php echo date("d M Y", strtotime($row->created_at)); ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#myModal" data-link="<?php echo url('admin/template/user/delete/'.$row->user_templates_id); ?>"><i class="fa fa-trash"></i> </button>
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
