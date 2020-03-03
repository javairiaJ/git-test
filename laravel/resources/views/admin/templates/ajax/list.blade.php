

<div class="box-header with-border" style="font-family:Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
    <h3 class="box-title" style="color: #708090; font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;"><b>Listing</b></h3>
    <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button> 
    </div>
</div>
<div class="box-body">
    <div class="col-sm-12 pull-right">               

    </div>
    <?php if (count($oModel) > 0) { ?>
        <table class="table" id="order_table">
            <thead>
                <tr >
                    <th>#</th>
                    <th>Title</th>
                    <th>Code</th>
                    <th>Key</th>
                    <th>Created Date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($oModel as $row)
                @include('admin.templates.ajax.list_data')
                <?php $i++;
                ?>
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


