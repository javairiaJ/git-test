<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div style="padding:8px; box-sizing:border-box;font-family:sans-serif;">
            <h1 style="display:inline; color:#333; margin-top:40px;margin-bottom:40px; padding:3px 0px; font-weight:300;">Welcome to TaskMatch!</h1>
            <p style="margin-bottom:0px;">
                Thanks for becoming a part of the TaskMatch community where reliable people are ready to give you a helping hand around the home and office.
            </p>
            <p style="margin-bottom:0px;">
                Did we also mention there are no obligations to hire and it’s 100% free to post a task.
            </p>
            <p style="margin-bottom:0px;">
                So let's get your first task posted so we can make your life easier!
            </p>
            <div style="width:450px;margin-bottom:10px;">
             <img src="{{ URL::to('front/images/emails/register.png') }}" style="width:100%">   
            </div>
            <div style="margin-top:10px;">
                <a  href="{{ url('/') }}" target="_blank" style="display:block;width:360px;height:25px; line-height:25px; text-align:center; background:#c6275f; color: #fff; padding:9px 25px; text-decoration:none; box-shadow:inset 0px 0px 3px #fefefe;">
                    GET STARTED NOW
                </a>
            </div>
            <h4>Top Services</h4>
            <ol>
                <?php foreach ($categories as $cat) { ?>
                    <li><a style="color:#15c;font-size:12px;" href="{{ url('tasks?cat_id='.$cat->id) }}">{{ $cat->name }}</a></li>
                <?php } ?>
            </ol>
            <p style="margin-bottom:0px;font-weight:bold;">Many thanks,</p>
            <p style="margin-bottom:0px;font-weight:bold;">The TaskMatch.ie Team</p>
            <br>
            <div style="width:200px;margin-bottom:10px;"><a href="{{ URL::to('/') }}"><img src="{{ URL::to('front/images/logo.png') }}" alt="logo" style="width:100%"></a>
            </div>
            <h4 style="margin-bottom:0px">Stay In Touch with us</h4>
            <a href="https://www.facebook.com/TaskMatch-1528535830788580/info/?tab=page_info&edited=category" target="_blank" style="display:inline-block;">
                <img style="width:38px;height:38px;border-radius:50%;" src="{{ URL::to('front/images/emails/facebook.png') }}"></a>
            <a href="https://twitter.com/Task_Match" target="_blank" style="display:inline-block;    vertical-align: sub;"><img style="width:47px;height:47px;border-radius:50%; " src="{{ URL::to('front/images/emails/twitter.png') }}"></a>
            <a href="https://www.instagram.com/taskmatch/?hl=en" target="_blank" style="display:inline-block;"><img style="width: 35px;height: 35px;border-radius: 50%;margin-bottom: 3px" src="{{ URL::to('front/images/emails/instagram.png') }}"></a>
            <br>
            <small style="margin-bottom:0px;">
                Need more help getting started? Check out our <a style="color:#15c;font-size:12px;"href="<?php echo url('faqs') ?>">FAQs</a> or <a style="color:#15c;font-size:12px;"href="<?php echo url('contact-us') ?>">contact us</a> - We're here to help you.
            </small>
        </div>
    </body>
</html>
