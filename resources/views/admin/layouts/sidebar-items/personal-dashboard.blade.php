@php
    $sectionsActive = request()->routeIs([
        'admin.prayers.*',
        'dashboard.debts.*',
        'admin.personal.todo-categories.*',
        'admin.personal.todo-tasks.*',
        'admin.personal.weekly-planner.*',
    ]);
@endphp

<li class="sidebar-dropdown {{ $sectionsActive ? 'active' : '' }}">
    <a href="#" data-bs-toggle="collapse" data-bs-target="#personalDashboardSections"
        aria-expanded="{{ $sectionsActive ? 'true' : 'false' }}">
        <i class="bi bi-grid"></i>
        <span class="menu-text">Personal Dashboard</span>
    </a>

    <div id="personalDashboardSections" class="sidebar-submenu collapse {{ $sectionsActive ? 'show' : '' }}">
        <ul class="pl-0">
            <li class="{{ request()->routeIs('admin.prayers.*') ? 'active' : '' }}">
                <a href="{{ route('admin.prayers.index') }}"
                    class="{{ request()->routeIs('admin.prayers.*') ? 'current-page' : '' }}">
                    <i class="bi bi-moon-stars"></i> Prayer Counters
                </a>
            </li>

            <li class="{{ request()->routeIs('dashboard.debts.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.debts.index') }}"
                    class="{{ request()->routeIs('dashboard.debts.*') ? 'current-page' : '' }}">
                    <i class="bi bi-cash-stack"></i> Debt / Credit
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.personal.todo-categories.*') ? 'active' : '' }}">
                <a href="{{ route('admin.personal.todo-categories.index') }}"
                    class="{{ request()->routeIs('admin.personal.todo-categories.*') ? 'current-page' : '' }}">
                    <i class="bi bi-tags"></i> Tasks Categories
                </a>
            </li>
            <li class="{{ request()->routeIs('admin.personal.todo-tasks.*') ? 'active' : '' }}">
                <a href="{{ route('admin.personal.todo-tasks.index') }}"
                    class="{{ request()->routeIs('admin.personal.todo-tasks.*') ? 'current-page' : '' }}">
                    <i class="bi bi-check2-square"></i> Tasks
                </a>
            </li>


            <li class="{{ request()->routeIs('admin.personal.weekly-planner.*') ? 'active' : '' }}">
                <a href="{{ route('admin.personal.weekly-planner.show') }}"
                    class="{{ request()->routeIs('admin.personal.weekly-planner.*') ? 'current-page' : '' }}">
                    <i class="bi bi-calendar-week"></i> Weekly Planner
                </a>
            </li>

        </ul>
    </div>
</li>
