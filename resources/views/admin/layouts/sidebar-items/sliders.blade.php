<li class="sidebar-dropdown {{ Request::is('dashboard/sliders') ? 'active' : '' }}">
    <a href="#">
        <i class="bi bi-house-fill"></i>
        <span class="menu-text">Component</span>
    </a>
    <div class="sidebar-submenu">
        <ul>
            <li class="{{ Request::segment(2) == 'sliders' ? 'active' : '' }}">
                <a href="{{ route('admin.sliders.index') }}"
                    class="{{ Request::segment(2) == 'sliders' ? 'current-page' : '' }}">
                    <i class="icon-view_carousel"></i>Slider & Banner
                </a>
            </li>
        </ul>
    </div>
</li>
