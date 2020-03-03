@extends('front.layouts.app')
<?php
$title = 'Successfully Verfied';
$description = '';
$keywords = '';
?>
@include('front/commons/meta')
@section('content')
<section class="account-area">
    <div class="container">

        <div class="reg-area text-center p50 mb50">
            <div class="hed">
                <h2>Thank you <span><?php echo $user->firstName ?> <?php echo $user->lastName ?></span></h2>
            </div>
            <p class="lead">You have successfully verified your account.</p>
            <?php if (!isset(Auth::user()->id)) { ?>
            <div class="text-center col-sm-12">
                <a href="{{ URL('checkout/'.$user->key) }}" class="btn btn-primary btn-flat "> Checkout</a>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
@endsection
