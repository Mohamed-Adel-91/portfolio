<!-- Sidebar wrapper start -->
<nav id="sidebar" class="sidebar-wrapper">

    <!-- Sidebar brand start  -->
    <div class="sidebar-brand">
        <a href="{{ url('/') }}" class="logo"
            style="text-decoration: none;
                font-size: medium;
                color: #fff;
                font-weight: bold;">
            Mohamed Adel Dashboard
            {{-- <img src="{{ asset('/assets/img/2.png') }}" alt="Admin Dashboard" /> --}}
        </a>
    </div>
    <!-- Sidebar brand end  -->

    <!-- Sidebar content start -->
    <div class="sidebar-content">

        <!-- sidebar menu start -->
        <div class="sidebar-menu">
            <ul class="pl-0">
                <li class="header-menu">General</li>

                <li class="{{ Request::segment(1) == 'dashboard' && is_null(Request::segment(2)) ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}"
                        class="{{ Request::segment(1) == 'dashboard' && is_null(Request::segment(2)) ? 'current-page' : '' }}">
                        <i class="icon-message"></i>Contact Requests
                    </a>
                </li>

                <li class="{{ Request::segment(2) == 'settings' ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.edit') }}"
                        class="{{ Request::segment(2) == 'settings' ? 'current-page' : '' }}">
                        <i class="icon-settings"></i>Settings
                    </a>
                </li>

                <!-- sidebar sections start -->
                @include('admin.layouts.sidebar-items.sections')
                <!-- sidebar sections end -->

            </ul>
        </div>
        <!-- sidebar menu end -->
    </div>
    <!-- Sidebar content end -->
</nav>
<!-- Sidebar wrapper end -->
