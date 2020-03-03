<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<style>
    .login-page, .register-page {
        background: #203b51 !important;
    }

</style>
<div class="register-box-body">
    <a href="">
        <p class="login-box-msg">{{ config('constants.site_name', 'Laravel') }}</p>
    </a>
<!--    <a href="{{ url('/')}}">
        <img src="{{ asset('front/images/logo.png') }}" alt="Logo" >
    </a>-->
    <p class="login-box-msg">Login to start your session</p>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/login') }}" style="margin-top: 20pzx">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback ">
            <div class="col-md-12">
                <input id="email" type="email" class="form-control" placeholder="Your Email" name="email" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
            <div class="col-md-12">
                <input id="password" type="password" class="form-control" placeholder="Your Password" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>                </div>
        </div>
        <div class="row form-group">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" class="form-control" name="remember" {{ old('remember')? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-flat btn-block form-btn">
                    Login
                </button>
            </div>
        </div>
    </form>
    <!--    <a href="{{url('password/reset')}}">
            Forgot Your Password?
        </a><br>-->
    <!--    <a href="{{ URL('signup') }}">Register a new membership</a>-->
</div>
