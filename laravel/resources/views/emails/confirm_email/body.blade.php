<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body class="email-template">
        <div style="padding:8px; box-sizing:border-box;font-family:sans-serif;">
            <h1 style="display:inline; color:#333; margin-top:40px;margin-bottom:40px; padding:3px 0px; font-weight:300;">Please verify your email address!</h1>
            <h4><a style="color:#15c;font-size:12px;"href="{{ URL::to('register/verify/' . $sConfirmationCode) }}">
                    {{ URL::to('register/verify/' . $sConfirmationCode) }}</a>
            </h4>
            <div style="margin-top:10px;">
                <p>Your created E-mail:  <strong>{{$sEmail}}</strong></p>
            </div>

            <div style="margin-top:10px;">
                <a  href="{{ URL::to('register/verify/' . $sConfirmationCode) }}" style="display:inline;width:170px;height:40px; line-height:40px; text-align:center; background:#3e8ff8; color: #fff; padding:9px 25px; text-decoration:none; box-shadow:inset 0px 0px 3px #fefefe;">Verify Your Account</a>
            </div>
<!--            <p style="margin-bottom:0px;">Thanks for signing up to {{Config::get('params.site_name')}}. Click the button above to confirm your email address. Verifying is the easiest way for you to build trust in the {{Config::get('params.site_name')}} community.
        </p>-->

        </div>
    </body>
</html>
