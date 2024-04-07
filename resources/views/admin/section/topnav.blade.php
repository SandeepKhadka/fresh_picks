<!-- START HEADER-->
<header class="header">
    <div class="page-brand" style="background-color: #f4f4f4; padding: 20px; color: black">
        <a class="link" href="{{ route(Auth::user()->role) }}">
            <span class="brand" >
                <span class="brand-tip" >Fresh Picks</span>
            </span>
            <span class="brand-mini">AE</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
            </li>
        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            {{-- <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    @if (file_exists(public_path() . '/uploads/user/' . auth()->user()->image))
                        <img src="{{ asset('uploads/user' . auth()->user()->image) }}" alt="">
                    @else
                        <i class="fa fa-user" style="margin-right: 10px"></i>
                    @endif
                    {{ auth()->user()->name }}<i class="fa fa-angle-down m-l-5"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout_form').submit();">
                        <i class="fa fa-power-off"></i>Logout</a>
                    <form action="{{ route('logout') }}" method="post" class="" id="logout_form">
                        @csrf
                    </form>
                </ul>

            </li> --}}
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout_form').submit();">
                <i class="fa fa-power-off"></i>Logout</a>
            <form action="{{ route('logout') }}" method="post" class="" id="logout_form">
                @csrf
            </form>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
<!-- END HEADER-->
