@extends('front.layouts.app')

@section('content')
<style >
    .split {
  height: 100%;
  width: 50%;
  position: fixed;
  z-index: 1;
 /* top: 0;*/
  overflow-x: hidden;
  padding-top: 20px;
}

.left {
  left: 0;
  
}

.right {
  right: 0;
  
}

.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: left;
}
.centeredd {
  position: absolute;
  top: 40%;
  left: 40%;
  transform: translate(-50%, -50%);
  text-align: left;
}


.centered img {
  width: 1000px;
 
}

</style>

<div class="split left">
  <div class="centered">
    <img src="{{ asset('front\images\bb.jpg') }}" alt="Avatar woman">
  </div>
</div>

<div class="split right">
  <div class="centeredd">
    <div class="panel-heading" style="font-size:6vw; color:#cd0011; padding-left: 80px;font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; padding-bottom: 40px; text-align: center;">Connect</div>
    <div class="panel-body" style=" font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; ">
    @include('front.commons.errors')
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6" >
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" style="width: 160%;" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6" >
                                <input id="password" type="password" class="form-control" name="password" style="width: 160%;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="border-radius: 2px;     padding: 6px 1px; width: 100px;">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #2F4F4F;     padding: 6px 1px;">Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
  </div>
</div>

<script>
    $('form').submit(function () {
        $(this).find('button').prop('disabled', true);
    });
</script>
@endsection
