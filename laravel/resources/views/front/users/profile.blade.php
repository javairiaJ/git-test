@extends('front.layouts.app')

@section('content')
<?php
$role = Auth::user()->role->role;
?>
<section class="dashboard-area">
    <div class="container">
        @include('front/commons/errors')
        <div class="dash__rgt col-sm-9">
            <div class="tab-content">
                <div id="profile" class="tab-pane fade active in">

                    <div class="profile__dtl col-sm-12">
                        <div class="profile__btns clrlist">
                            <ul class="pul-rgt">
                                @if($user->status == 1)
                                <li><a href="#" class="profile__approve__btn"><i class="fa fa-check-square-o"></i>Approved</a></li>
                                @endif
                                <li><a href="{{url('profile/edit')}}" class="profile__edit__btn"><i class="fa fa-pencil"></i>Edit Profile</a></li>
                            </ul>
                        </div>


                        <div class="clearfix"></div>

                        <div class="profile__info">

                            <div class="label-box col-sm-6">
                                <h5>Name:</h5>
                                <h4>{{$user->firstName}} {{$user->middleName}} {{$user->lastName}}</h4>
                            </div>

                            <div class="label-box col-sm-6">
                                <h5>Email:</h5>
                                <h4>{{$user->email}}</h4>
                            </div>
                            <div class="label-box col-sm-6">
                                <h5>Designation:</h5>
                                <h4>{{$user->designation}}</h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  


@endsection