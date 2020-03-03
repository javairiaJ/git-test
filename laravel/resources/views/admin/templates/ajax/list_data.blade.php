<tr>
    <td><?php echo $i; ?></td>
    <td><a href="{{ url('admin/template/'.$row->id) }}"><?php echo $row->title; ?></a></td>
    <td><?php echo $row->code; ?></td>
    <td><?php echo $row->key; ?></td>
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
        <?php if (Auth::user()->role->code == 'admin') { ?>
            <a href="{{ url('admin/template/view/'.$row->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
        <?php } ?>
    </td>
</tr>