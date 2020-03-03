<?php
$currencies = Config::get('params.currencies');
$currency = $currencies[Config::get('params.currency_default')]['symbol'];
?>
<div class="box-header with-border">
    <h3 class="box-title">( Total Back Logs : {{ count($model) }} )</h3>
</div>
<div class="box-body">
    <div class="col-sm-12 pull-right">               
<!--        <a href="{{ URL::to('admin/download/csv') }}"><button class="btn btn-success pull-right"><i class="fa fa-download"></i> Download CSV</button></a>-->
        <!--                <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="file" name="import_file" />
                            <button class="btn btn-primary">Import File</button>
                        </form>-->
    </div>
    <?php if (count($model) > 0) { ?>
        <table class="table" id="backLogs">
            <thead>
                <tr >
                    <th>#</th>
                    <th>EventType</th>
                    <th>EventDetail</th>
                    <th>EventReason</th>
                    <th>Date</th>
                    <th>Status</th>
<!--                    <th></th>-->
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($model as $row)
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row->eventType; ?></td>
                    <td><?php echo $row->eventDetail; ?></td>
                    <td><?php echo $row->eventReason; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row->created_at)); ?></td>
                                        <?php
                    if ($row->status == 1) {
                        $status = 'success';
                        $text = 'Active';
                    } else {
                        $status = 'danger';
                        $text = 'Expired / Blocked / Deactive';
                    }
                    ?>
                    <td><span class ="label label-{{$status}}">{{$text}}</span></td>
<!--                    <td><button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#myModal" data-link="back-logs/delete/<?php //echo $row->id ?>"><i class="fa fa-trash"></i> </button></td>-->
                </tr>
                <?php $i++; ?>
                @endforeach
                @include('admin/commons/delete_modal')
            </tbody>

        </table>

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
    $(document).ready(function () {
        $('#backLogs').DataTable({
//            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "pagingType": "simple_numbers"
        });
    });
</script>


