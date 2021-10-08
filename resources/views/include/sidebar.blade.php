<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
                <h6>CGWC Attendance</h6>
                {{-- <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="Bayregistry"> --}}
            </div>
        </a>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>
    @php
    $segment1 = request()->segment(1);
    @endphp
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == '') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-home"></i><span>{{ __('Main Dashboard')}}</span></a>
                </div>
               @role('Super Admin')
               <div class="nav-item {{ ($segment1 == 'users') ? 'active' : '' }}">
                <a href="{{url('/beneficiary/create')}}"><i class="ik ik-file-text"></i><span>{{ __('Upload Leaders')}}</span> </a>
            </div>
            <div class="nav-item {{ ($segment1 == 'login-1' || $segment1 == 'register'||$segment1 == 'forgot-password') ? 'active open' : '' }} has-sub">
                <a href="#"><i class="ik ik-book-open"></i><span>{{ __('Manage Session')}}</span></a>
                <div class="submenu-content">
                    <a href="{{url('/session/create')}}" class="menu-item {{ ($segment1 == 'login-1') ? 'active' : '' }}">{{ __('Add Session')}}</a>
                    <a href="{{url('/session/list')}}" class="menu-item {{ ($segment1 == 'login-1') ? 'active' : '' }}">{{ __('View Session')}}</a>

                </div>
            </div>
               @endrole



                <div class="nav-item {{ ($segment1 == 'login-1' || $segment1 == 'register'||$segment1 == 'forgot-password') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-award"></i><span>{{ __('Manage Attendance')}}</span></a>
                    <div class="submenu-content">

                       @if (Auth::user()->role == "elder")
                       <a href="{{url('/attendance/list')}}" class="menu-item {{ ($segment1 == 'login-1') ? 'active' : '' }}">{{ __('Take Attendance')}}</a>
                       @endif
                       @role('Super Admin')
                       <a href="{{url('/attendance-admin/list')}}" class="menu-item {{ ($segment1 == 'login-1') ? 'active' : '' }}">{{ __('Confirm Attendance')}}</a>
                       @endrole

                    </div>
                </div>

                <div class="nav-item {{ ($segment1 == 'icons') ? 'active' : '' }}">
                    <a href="{{url('logout')}}"><i class="ik ik-log-out"></i><span>{{ __('Logout')}}</span></a>
                </div>
        </div>
    </div>
</div>
