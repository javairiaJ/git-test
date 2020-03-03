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
                <h3 class="box-title">Basic Information </h3>
                <div class="box-tools pull-right">
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button> -->

                </div>
            </div>

            <?php
            //$user = $data[0];
            ?>        
            @if($oUser->status == '1')
            <div class="box-body bg-success">
                @else
                <div class="box-body bg-danger">
                    @endif
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="col-sm-12 user-detail-image">
                                @if($oUser->image == '')
                                <img  src="{{ asset('front/images/usr.jpg')}}" alt="User Avatar">
                                @else
                                <img src="{{ asset('uploads/users/profile/'.$oUser->image) }}" alt="User Avatar">
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>First Name :</td>
                                        <td>{{ $oUser->firstName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Last Name :</td>
                                        <td>{{ $oUser->lastName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email :</td>
                                        <td>{{ $oUser->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Role :</td>
                                        <td>{{ $aRoles[$oUser->role_id] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Designation :</td>
                                        <td>{{ $oUser->designation }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    @include('admin/commons/users_action')
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
