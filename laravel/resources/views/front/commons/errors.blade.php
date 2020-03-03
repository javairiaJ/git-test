@if (count($errors) > 0)
<div class="">
    <div class="alert alert-danger alert-dismissable">
<!--        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
        <h4><i class="fa fa-ban"></i> Alert!</h4>
        <strong>Whoops!</strong> There were some problems with your input.<br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
@if (Session::has('success'))
<div class="alert alert-success alert-dismissible">
<!--    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
    <h4><i class="fa fa-check"></i> Alert!</h4>
    {!! session('success') !!}
</div>

@endif
@if (Session::has('danger'))
<div class="alert alert-danger alert-dismissible">
<!--    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
    <h4><i class="fa fa-ban"></i> Alert!</h4>
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    {!! session('danger') !!}
</div>
@endif
<script>
    window.setTimeout(function () {
        jQuery(".alert").fadeTo(1000, 0).slideUp(1000, function () {
            jQuery(this).remove();
        });
    }, 4000);
</script>