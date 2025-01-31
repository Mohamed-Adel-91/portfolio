<li class="sidebar-dropdown {{ Request::is('dashboard/sections') ? 'active' : '' }}">
    <a href="#" data-bs-toggle="collapse" data-bs-target="#websiteSections" aria-expanded="false">
        <i class="bi bi-house-fill"></i>
        <span class="menu-text">Website Sections</span>
    </a>
    <div id="websiteSections" class="sidebar-submenu collapse">
        <ul class="pl-0">
            <li class="{{ Request::is('dashboard/intro') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/intro') ? 'current-page' : '' }}">
                    <i class="icon-view_carousel"></i> Intro
                </a>
            </li>
            <li class="{{ Request::is('dashboard/about') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/about') ? 'current-page' : '' }}">
                    <i class="icon-view_carousel"></i> About
                </a>
            </li>
            <li class="{{ Request::is('dashboard/education') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/education') ? 'current-page' : '' }}">
                    <i class="icon-view_carousel"></i>Education
                </a>
            </li>
            <li class="{{ Request::is('dashboard/experience') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/experience') ? 'current-page' : '' }}">
                    <i class="icon-view_carousel"></i>Experience
                </a>
            </li>
            <li class="{{ Request::is('dashboard/resume') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/resume') ? 'current-page' : '' }}">
                    <i class="icon-view_carousel"></i>Resume
                </a>
            </li>
            <li class="{{ Request::is('dashboard/skills') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/skills') ? 'current-page' : '' }}">
                    <i class="icon-view_carousel"></i>Skills
                </a>
            </li>
            <li class="{{ Request::is('dashboard/gallery') ? 'active' : '' }}">
                <a href="#" class="{{ Request::is('dashboard/gallery') ? 'current-page' : '' }}">
                    <i class="icon-view_carousel"></i>Gallery
                </a>
            </li>
            <li class="sidebar-dropdown {{ Request::is('projects') ? 'active' : '' }}">
                <a href="#" data-bs-toggle="collapse" data-bs-target="#projectsView" aria-expanded="false">
                    <i class="bi bi-house-fill"></i>
                    <span class="menu-text">Projects View</span>
                </a>
                <div id="projectsView" class="sidebar-submenu collapse">
                    <ul>
                        <li class="{{ Request::is('dashboard/projects') ? 'active' : '' }}">
                            <a href="#" class="{{ Request::is('dashboard/projects') ? 'current-page' : '' }}">
                                <i class="icon-view_carousel"></i> Projects
                            </a>
                        </li>
                        <li class="{{ Request::is('dashboard/portfolio') ? 'active' : '' }}">
                            <a href="#" class="{{ Request::is('dashboard/portfolio') ? 'current-page' : '' }}">
                                <i class="icon-view_carousel"></i> Portfolio
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</li>
