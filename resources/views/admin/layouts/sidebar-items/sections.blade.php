@php
    $sectionsActive = request()->routeIs([
        'admin.intro.*',
        'admin.about.*',
        'admin.education.*',
        'admin.resume.*',
        'admin.experience.*',
        'admin.projects.*',
        'admin.portfolio.*',
        'admin.gallery.*',
        'admin.skills.*',
    ]);
@endphp

<li class="sidebar-dropdown {{ $sectionsActive ? 'active' : '' }}">
    <a href="#" data-bs-toggle="collapse" data-bs-target="#websiteSections"
        aria-expanded="{{ $sectionsActive ? 'true' : 'false' }}">
        <i class="bi bi-grid"></i>
        <span class="menu-text">Website Sections</span>
    </a>

    <div id="websiteSections" class="sidebar-submenu collapse {{ $sectionsActive ? 'show' : '' }}">
        <ul class="pl-0">
            <li class="{{ request()->routeIs('admin.intro.*') ? 'active' : '' }}">
                <a href="{{ route('admin.intro.edit') }}"
                    class="{{ request()->routeIs('admin.intro.*') ? 'current-page' : '' }}">
                    <i class="bi bi-card-heading"></i> Intro
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                <a href="{{ route('admin.about.edit') }}"
                    class="{{ request()->routeIs('admin.about.*') ? 'current-page' : '' }}">
                    <i class="bi bi-person-fill"></i> About
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.resume.*') ? 'active' : '' }}">
                <a href="{{ route('admin.resume.index') }}"
                    class="{{ request()->routeIs('admin.resume.*') ? 'current-page' : '' }}">
                    <i class="bi bi-file-earmark-text-fill"></i> Resume Titles
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.education.*') ? 'active' : '' }}">
                <a href="{{ route('admin.education.index') }}"
                    class="{{ request()->routeIs('admin.education.*') ? 'current-page' : '' }}">
                    <i class="bi bi-mortarboard-fill"></i> Education
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.experience.*') ? 'active' : '' }}">
                <a href="{{ route('admin.experience.index') }}"
                    class="{{ request()->routeIs('admin.experience.*') ? 'current-page' : '' }}">
                    <i class="bi bi-briefcase-fill"></i> Experience
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <a href="{{ route('admin.projects.index') }}"
                    class="{{ request()->routeIs('admin.projects.*') ? 'current-page' : '' }}">
                    <i class="bi bi-kanban"></i> Projects
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.portfolio.*') ? 'active' : '' }}">
                <a href="{{ route('admin.portfolio.index') }}"
                    class="{{ request()->routeIs('admin.portfolio.*') ? 'current-page' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Portfolio
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <a href="{{ route('admin.gallery.index') }}"
                    class="{{ request()->routeIs('admin.gallery.*') ? 'current-page' : '' }}">
                    <i class="bi bi-images"></i> Gallery
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                <a href="{{ route('admin.skills.index') }}"
                    class="{{ request()->routeIs('admin.skills.*') ? 'current-page' : '' }}">
                    <i class="bi bi-stars"></i> Skills
                </a>
            </li>
        </ul>
    </div>
</li>
