<!-- Logo -->
<a href="{{ url('/') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">
        <img src="{{asset('front/images/favicon.png')}}" class="img-circle" alt="logo" style="width: 100%;">
        <!--             @if(Auth::user()->image == '')
                    <img src="{{ asset('front/images/noimage.jpg')}}" class="img-circle" alt="logo" style="width: 100%;">
                    @else
                    <img src="{{ asset('uploads/users/profile/'. Auth::user()->image)}}" class="img-circle" alt="logo" style="width: 100%;">
                    @endif -->
    </span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b><img src="{{asset('front/images/logo.png')}} " style="width:160px;"></b></span>
</a>