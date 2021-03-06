<header class="main-header">
    <a href="{{url('dashboard')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
New
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">

            Home</span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

    <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 notifications</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li><a href="#"><i class="fa fa-users text-aqua"></i>You have pending Notifications</a></li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        @if(Auth::user()->user_image!=null)
                            <img class="user-image"
                                 src="{{asset('/storage/uploads/users/images/profilePic/'.Auth::user()->user_image)}}"
                                 alt="User Image" height="160px">
                        @else
                            <img class="user-image"
                                 src="{{url('/uploads/images/dummyUser.gif')}}"
                                 alt="User Image" height="160px">
                        @endif
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            @if(Auth::user()->user_image!=null)
                                <img class="img-circle"
                                     src="{{asset('/storage/uploads/users/images/profilePic/'.Auth::user()->user_image)}}"
                                     alt="User Image" height="160px">
                            @else
                                <img class="img-circle"
                                     src="{{url('/uploads/images/dummyUser.gif')}}"
                                     alt="User Image" height="160px">
                            @endif

                            <p>
                                {{Auth::user()->name}}
                                <small>Member since {{date("j M. Y", strtotime(Auth::user()->created_at))}}</small>
                            </p>
                        </li>

                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                   class="btn btn-default btn-flat">
                                    Sign out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>