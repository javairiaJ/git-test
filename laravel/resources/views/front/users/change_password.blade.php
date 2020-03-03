@extends('front.layouts.app')
@section('content')
<?php
$required = 'required';
?>

<section class="dashboard-area">

    <div class="container">
        @include('front/commons/errors')
        <div class="dash__rgt col-sm-9">
            <div class="tab-content">

                <div class="hed"><h2 style="margin-left: 30px;">Change <span>Password</span></h2></div>

                <div id="profile" class="tab-pane fade active in">
                    <br>
                    <div class="profile__dtl col-sm-6 pul-cntr">
                        {!! Form::open(array( 'class' => 'form','url' => 'password/update', 'method' => 'post')) !!}
                        <div class="form-group col-md-12">
                            <label>Current Password</label>
                            {!! Form::password('currentPassword', ['class'=>'form-control','placeholder'=>'Current Password',$required]) !!}
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-12">
                            <label>New Password</label>
                            {!! Form::password('password', ['class'=>'form-control','placeholder'=>'New Password',$required]) !!}
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-md-12">
                            <label>Confirm Password</label>
                            {!! Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Confirm Password',$required]) !!}
                        </div>                        
                        <div class="clearfix"></div>
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit" style="width: 70%;">
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  
@endsection