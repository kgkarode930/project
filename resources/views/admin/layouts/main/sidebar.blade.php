<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->check() ? auth()->user()->profile_image : asset('assets/dist/img/default-avatar.png') }}"
                    style="height: 45px;width: 45px;" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                    @if (Auth::user())
                        {{ Auth::user()->name }}
                    @else
                        Guest
                    @endif
                </p>
                <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                <a href="{{ route('dashboardIndex') }}"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a>
            </li>
            <li class="{{ Request::is('countries*') ? 'active' : '' }}">
                <a href="{{ route('countries.index') }}"><i class="fa fa-building"></i>COUNTRY LIST</a>
            </li>
            <li class="{{ Request::is('states*') ? 'active' : '' }}">
                <a href="{{ route('states.index') }}"><i class="fa fa-building"></i>STATES LIST</a>
            </li>
            <li class="{{ Request::is('cities*') ? 'active' : '' }}">
                <a href="{{ route('cities.index') }}"><i class="fa fa-building"></i>CITIES</a>
            </li>
            <li class="{{ Request::is('users*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}"><i class="fa fa-building"></i>USERS</a>
            </li>

            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i>LOGOUT</a></li>
        </ul>
        </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
