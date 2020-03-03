@extends('admin/admin_template')

@section('content')

<style>
    .skin-black .sidebar-menu>li:hover>a, .skin-black .sidebar-menu>li.active>a {
    color: #fff;
    background: gainsboro!important;
    border-left-color: #fff !important;
}
hr{
    background-color:  #87438e;
    height: 2px; border: 0;
}
</style>
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))

    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @endforeach
</div> <!-- end .flash-message -->
<!-- Content Header (Page header) -->
<section class="content-header" style="color: #87438e; ">
    <h1 style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<hr>

<!-- Main content -->
<section class="content" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">

    <!-- Small boxes (Stat box) -->
    <div class="row {{ (Auth::user()->role->code != 'admin')? 'hidden':''}}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">

        <div class="col-lg-3 col-xs-6" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        {{ $iTotalUsers }}
                    </h3>
                    <p>
                        User Registrations
                    </p>
                </div>
                <div class="icon"  >
                    <i class="fa fa-user-plus"></i>
                </div>
                <a href="{{ url('admin/users') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6 hidden">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        {{ $iTotalModules }}
                    </h3>
                    <p>
                        Total Modules
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-plus"></i>
                </div>
                <a href="{{ url('admin/modules') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- ./col -->

    </div>

    <br><br>
    <div class="row {{ (Auth::user()->role->code != 'admin')? 'hidden':''}}" style="color: #708090;">
        <div class="col-lg-8 col-xs-12" style="color: #708090;">
            <div class="box" style="color: #708090;">
                <div class="box-header" style="color: #708090;">
                    <h3 class="box-title" style="color: #cd0011;">Recently Added Users</h3>
                    <div class="box-tools">
                    </div>
                </div> 
                <div class="box-body table-responsive no-padding">
                    @if(count($aRecentUsers) > 0)
                    <table class="table table-hover">
                        <tbody><tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            @foreach($aRecentUsers as $oUser)
                            <tr>
                                <td><a href="<?php echo url('admin/user/' . $oUser->id); ?>">{{$oUser->id}}</a></td>
                                <td><a href="<?php echo url('admin/user/' . $oUser->id); ?>">{{$oUser->firstName}} {{$oUser->lastName}}</a></td>
                                <td>{{date('d/m/Y',strtotime($oUser->created_at))}}</td>
                                <?php
                                if ($oUser->status == 1) {
                                    $sStatus = 'success';
                                    $sText = 'Active';
                                } else {
                                    $sStatus = 'danger';
                                    $sText = 'Deactive';
                                }
                                ?>
                                <td><span class ="label label-{{$sStatus}}">{{$sText}}</span></td>
                            </tr>
                            @endforeach
                        </tbody></table>
                    @if(count($aRecentUsers) > 5)
                    <div class="box-footer text-center">
                        <a href="{{ URL('admin/users') }}" class="uppercase">View All</a>
                    </div>
                    @endif
                    @else
                    <div class="col-sm-6">
                        <h3>No data found. . . . </h3>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
