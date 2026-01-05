@php
    $sectionsActive = request()->routeIs([
        'admin.prayers.*',
        // 'admin.tasks.*',
        // 'admin.debts.*',
        // 'admin.works.*'
    ]);
@endphp

<li class="sidebar-dropdown {{ $sectionsActive ? 'active' : '' }}">
    <a href="#" data-bs-toggle="collapse" data-bs-target="#websiteSections"
        aria-expanded="{{ $sectionsActive ? 'true' : 'false' }}">
        <i class="bi bi-grid"></i>
        <span class="menu-text">Personal Dashboard</span>
    </a>

    <div id="websiteSections" class="sidebar-submenu collapse {{ $sectionsActive ? 'show' : '' }}">
        <ul class="pl-0">
            <li class="{{ request()->routeIs('admin.prayers.*') ? 'active' : '' }}">
                <a href="{{ route('admin.prayers.index') }}"
                    class="{{ request()->routeIs('admin.prayers.*') ? 'current-page' : '' }}">
                    <i class="bi bi-moon-stars"></i> Prayer Counters
                </a>
            </li>

            {{-- <li class="{{ request()->routeIs('admin.tasks.*') ? 'active' : '' }}">
                <a href="{{ route('admin.tasks.edit') }}"
                    class="{{ request()->routeIs('admin.tasks.*') ? 'current-page' : '' }}">
                    <i class="bi bi-person-fill"></i> Tasks
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.works.*') ? 'active' : '' }}">
                <a href="{{ route('admin.works.index') }}"
                    class="{{ request()->routeIs('admin.works.*') ? 'current-page' : '' }}">
                    <i class="bi bi-file-earmark-text-fill"></i> work
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.debts.*') ? 'active' : '' }}">
                <a href="{{ route('admin.debts.index') }}"
                    class="{{ request()->routeIs('admin.debts.*') ? 'current-page' : '' }}">
                    <i class="bi bi-mortarboard-fill"></i> debt progress
                </a>
            </li> --}}
        </ul>
    </div>
</li>
