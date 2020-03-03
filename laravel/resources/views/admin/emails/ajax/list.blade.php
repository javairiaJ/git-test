<div class="box-header with-border">
    <h3 class="box-title">( Total Emails : {{ count($oModel) }} )</h3>
    <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button> 
    </div>
</div>
<div class="box-body">
    <div class="col-sm-12 pull-right">               
<!--        <a href="{{ URL::to('admin/download/csv') }}"><button class="btn btn-success pull-right"><i class="fa fa-download"></i> Download CSV</button></a>-->
        <!--                <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="file" name="import_file" />
                            <button class="btn btn-primary">Import File</button>
                        </form>-->
    </div>
    <?php if (count($oModel) > 0) { ?>
        <table class="table" id="order_table">
            <thead>
                <tr >
                    <th>#</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($oModel as $row)
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row->email; ?></td>
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
                    <td><span class ="label label-{{$sStatus}}">{{$sText}}</span></td>
                    <td>
                         <a href="{{ url('admin/email/view/'.$row->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="{{ url('admin/email/edit/'.$row->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#myModal" data-link="email/delete/<?php echo $row->id ?>"><i class="fa fa-trash"></i> </button>

                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                @include('admin/commons/delete_modal')
            </tbody>

        </table>
        <?php echo $oModel->appends(Input::query())->render(); ?>

    <?php } else {
        ?>
        <div class="">
            No Data found. . .
        </div>
    </div>
<?php }
?>
<script>
    jQuery('.delete').click(function ()
    {
        $('#closemodal').attr('href', $(this).data('link'));
    });
</script>


