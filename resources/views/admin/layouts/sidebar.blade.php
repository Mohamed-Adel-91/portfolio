<!-- Sidebar wrapper start -->
<nav id="sidebar" class="sidebar-wrapper">

    <!-- Sidebar brand start  -->
    <div class="sidebar-brand">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('/assets/img/logo.png') }}" alt="Admin Dashboard" />
        </a>
    </div>
    <!-- Sidebar brand end  -->

    <!-- Sidebar content start -->
    <div class="sidebar-content">

        <!-- sidebar menu start -->
        <div class="sidebar-menu">
            <ul>
                <li class="header-menu">General</li>

                <li class="{{ Request::segment(1) == 'dashboard' && is_null(Request::segment(2)) ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}"
                        class="{{ Request::segment(1) == 'dashboard' && is_null(Request::segment(2)) ? 'current-page' : '' }}">
                        <i class="icon-message"></i>Contact Requests
                    </a>
                </li>

                <!-- sidebar sliders start -->
                @include('admin.layouts.sidebar-items.sliders')
                <!-- sidebar sliders end -->

                <li class="{{ Request::segment(2) == 'settings' ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.edit') }}"
                        class="{{ Request::segment(2) == 'settings' ? 'current-page' : '' }}">
                        <i class="icon-settings"></i>Settings
                    </a>
                </li>

            </ul>
        </div>
        <!-- sidebar menu end -->
    </div>
    <!-- Sidebar content end -->
</nav>
<!-- Sidebar wrapper end -->
