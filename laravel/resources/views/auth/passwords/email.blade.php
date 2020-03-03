@extends('front.layouts.app')

@section('content')
<div class="container" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="background-color: #ED9121;" >
                <div class="panel-heading" style="background-color: #ED9121; color:#2F4F4F; ">
                    <b>Forgot your password</b></div>
                

                <div class="panel-body" style="color:#2F4F4F;">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <p>Enter your email address to reset your password</p>
                    
                    
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}" style="color:#2F4F4F;">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6" >
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" style="width: 100%;" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" >
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
