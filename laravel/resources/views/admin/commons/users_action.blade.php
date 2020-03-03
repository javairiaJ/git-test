<div class="col-sm-12">
    <div class="pull-left">
        <a href="<?php echo url('admin/users'); ?>" class="btn btn-default"> Back</a>
    </div>
    <div class="pull-right">
        @if($oUser->status == '1')
        <a href="<?php echo url('admin/user/disapprove/' . $oUser->id); ?>" class="btn btn-default"> Deactive</a>
        @else
        <a href="<?php echo url('admin/user/approve/' . $oUser->id); ?>" class="btn btn-default">Active</a>
        @endif
    </div>
</div>