<li class="sidebar-dropdown {{ Request::is('dashboard/sections/*') ? 'active' : '' }}">
    <a href="#" data-bs-toggle="collapse" data-bs-target="#websiteSections" aria-expanded="false">
        <i class="bi bi-grid"></i> <!-- General sections icon -->
        <span class="menu-text">Website Sections</span>
    </a>
    <div id="websiteSections" class="sidebar-submenu collapse">
        <ul class="pl-0">
            <li class="{{ Request::is('dashboard/sections/intro/edit') ? 'active' : '' }}">
                <a href="{{ route('admin.intro.edit') }}" class="{{ Request::is('dashboard/sections/intro/edit') ? 'current-page' : '' }}">
                    <i class="bi bi-card-heading"></i> Intro
                </a>
            </li>
            <li class="{{ Request::is('dashboard/sections/about/edit') ? 'active' : '' }}">
                <a href="{{ route('admin.about.edit') }}" class="{{ Request::is('dashboard/sections/about/edit') ? 'current-page' : '' }}">
                    <i class="bi bi-person-fill"></i> About
                </a>
            </li>
            <li class="{{ Request::is('dashboard/education') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/education') ? 'current-page' : '' }}">
                    <i class="bi bi-mortarboard-fill"></i> Education
                </a>
            </li>
            <li class="{{ Request::is('dashboard/experience') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/experience') ? 'current-page' : '' }}">
                    <i class="bi bi-briefcase-fill"></i> Experience
                </a>
            </li>
            <li class="{{ Request::is('dashboard/resume') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/resume') ? 'current-page' : '' }}">
                    <i class="bi bi-file-earmark-text-fill"></i> Resume
                </a>
            </li>
            <li class="{{ Request::is('dashboard/skills') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/skills') ? 'current-page' : '' }}">
                    <i class="bi bi-stars"></i> Skills
                </a>
            </li>
            <li class="{{ Request::is('dashboard/gallery') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/gallery') ? 'current-page' : '' }}">
                    <i class="bi bi-images"></i> Gallery
                </a>
            </li>
            <li class="{{ Request::is('dashboard/projects') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/projects') ? 'current-page' : '' }}">
                    <i class="bi bi-kanban"></i> Projects
                </a>
            </li>
            <li class="{{ Request::is('dashboard/portfolio') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/portfolio') ? 'current-page' : '' }}">
                    <i class="bi bi-folder-fill"></i> Portfolio
                </a>
            </li>
        </ul>
    </div>
</li>
