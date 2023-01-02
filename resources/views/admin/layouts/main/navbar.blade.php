<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('dashboardIndex') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>AKS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{!! config('constants.APP_NAME') !!}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ auth()->check() ? auth()->user()->profile_image : asset('assets/dist/img/default-avatar.png') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">
                            @if (Auth::user())
                                {{ Auth::user()->name }}
                            @else
                                Guest
                            @endif
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
