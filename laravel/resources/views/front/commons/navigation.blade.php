

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<header class="main-header main-header__styling">


    <!-- Header Navbar -->
    <nav class="navbar navbar-default navbar-static-top">
    
     <!-- <img  src="{{ asset('front\images\logo1.PNG') }}"  style="width: 40px;" > --> 

        <div class="container">
            <div class="navbar-header">
              <img  src="{{ asset('front\images\logo1.PNG') }}"  style="width: 90px;" >

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
               <!--  <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('constants.site_name', 'Laravel') }}
                </a> -->
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse" style="font-size: 16px; font-family: 'Poppins', sans-serif;">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <!-- <ul class="nav navbar-nav navbar-right">
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul> -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                        <li><a href="{{ route('login') }}"     style="font-size: 2px;
    font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif;     padding-top: 18px;
    padding-bottom: 0px;" >.</a></li>
                        <!--                    <li><a href="{{--{{ route('register') }}--}}">Register</a></li>-->
                        @else
                        <div style="position: absolute; left: 40%; top: 5%; padding: 2px 2px 2px 2px;  ">
                        <li>
                            <a href="{{ url('dashboard') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:18px;color: #2F4F4F;position: absolute; left: -2000%; padding: 16px 2px 2px 2px;" onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F'"> Home </a>
                        </li>
                        <?php if (Auth::user()->role->code == 'hr' || Auth::user()->role->code == 'admin'|| Auth::user()->role->code == 'marketing' || Auth::user()->role->code == 'user') { ?>
                            <li>
                                <a href="{{ url('admin/templates') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:18px;color: #2F4F4F;position: absolute; left: 60%; padding: 16px 2px 2px 2px;" onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F'"> Templates </a>
                            </li>

                            <li>
                                <a href="{{ url('admin') }}" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:18px; color: #2F4F4F;position:absolute; right: -4000%; padding: 16px 2px 2px 2px;"  onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='#2F4F4F'"> Admin </a>
                            </li>
                        </div>
                        <?php } ?>
                        <li>
                             <button class="btn btn-default btn-sm btn-link noti-btn" style="font-size: 22px;margin-top: 8px; padding: 8px 25px 2px 0px;" onMouseOver="this.style.color='#E78E0A'" onmouseleave="this.style.color='#2F4F4F'">
                                 <span class="glyphicon glyphicon-globe"></span> 
                            </button> 
                            <!-- <span class="badge badge-notify unseen_notifications"></span> -->
                        </li>
                       

                        <li class="dropdown user user-menu" >
                            <a href="#" class="dropdown-toggle" style="padding: 20px 0px 0px 0px; color: #2F4F4F;" data-toggle="dropdown" onMouseOver="this.style.color='#cd0011'" onmouseleave="this.style.color='dimgray'" >
                                @if(Auth::user()->image == '')
                                <img src="{{ asset('front/images/noimage.jpg')}}" class="user-image" alt="User Image">
                                @else
                                <img src="{{ asset('uploads/users/profile/'. Auth::user()->image)}}" class="user-image" alt="User Image">
                                @endif 
                                <span style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:18px;">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                                <i class="caret" aria-hidden="true"></i> 
                            </a>

                            <ul class="dropdown-menu" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:18px;">
                                <li class="user-header">
                                    @if(Auth::user()->image == '')
                                    <img src="{{ asset('front/images/noimage.jpg')}}" class="img-circle" alt="User Image">
                                    @else
                                    <img src="{{ asset('uploads/users/profile/'. Auth::user()->image)}}" class="img-circle" alt="User Image">
                                    @endif
                                    <div class="user-name__name1" style="color: #2F4F4F;" onMouseOver="this.style.color='maroon'" onmouseleave="this.style.color='#2F4F4F'">
                                        <span class="hidden-xs name1" style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:16px;"onMouseOver="this.style.color='maroon'" onmouseleave="this.style.color='#2F4F4F'" >{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span><br>
                                        <small style="font-family: Candara,Calibri,Segoe,Segoe UI,Optima,Arial,sans-serif; font-size:12px;">Member since {{ date_format(Auth::user()->created_at, 'M. j Y') }}</small>
                                    </div>
                                </li>

                                <!-- <li>
                                    <a href="{{ url('dashboard') }}">Dashboard</a>
                                </li> -->
                                <li>
                                    <a href="{{ url('profile') }}" >Profile</a>
                                </li>
                                <li>
                                    <a href="{{ url('password/change')}}">Change Password</a>
                                </li>

                                <li>
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </ul>

        </div>
        </div>
    </nav>
    <div class="divider" style=" background-color:  #cd0011;
  height: 6px;  margin-top: -23px"></div>
</header>

