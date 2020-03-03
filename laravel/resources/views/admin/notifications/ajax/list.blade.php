<div class="box-header with-border" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
    <h3 class="box-title" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; color: #708090;"><b>( Total Notifications : {{ count($oModel) }} )</b></h3>
    <div class="box-tools" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button> 
    </div>
</div>
<div class="box-body" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; color: #708090;">
    <div class="col-sm-12 pull-right" style="color: #708090;">
    </div>
    <?php if (count($oModel) > 0) { ?>
        <table class="table" id="order_table" style="color: #708090;">
            <thead>
                <tr >
                    <th>#</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($oModel as $row)
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <a href="{{ url('notification/'.$row->id) }}">
                            <?php echo stripslashes($row->description); ?>
                        </a>
                    </td>
                    <td><?php echo date("d/m/Y", strtotime($row->created_at)) ?></td>
                    <td>
                        <!-- <a href="{{ url('admin/user/edit/'.$row->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a> -->
                        <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#myModal" data-link="notification/delete/<?php echo $row->id ?>"><i class="fa fa-trash"></i> </button>
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


