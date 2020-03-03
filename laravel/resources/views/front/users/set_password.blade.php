@extends('front.layouts.app')
<?php
$title = 'Set Password';
$description = '';
$keywords = '';
?>
@include('front/commons/meta')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Set Your Password</div>

                <div class="panel-body">
                    @include('front.commons.errors')
                    <div class="form">
                        <form method="POST" class="form" action="{{ url('postsetpassword') }}">
                            <input type="hidden"  name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" name="password" placeholder="Password *" value="{{ old('password') }}" required="required"/>
                                </div>  
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password *" required="required"/>
                                </div>
                            </div>




                            <div class="form-group col-sm-12">

                                <button type="submit" class="btn btn-primary w100">
                                    Submit
                                </button>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection