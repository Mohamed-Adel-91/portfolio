@extends('admin.layouts.master')

@section('content')
    @php
        $quadrantBadges = [
            'do' => 'bg-success',
            'defer' => 'bg-info',
            'delegate' => 'bg-primary',
            'delete' => 'bg-danger',
        ];
        $statusBadges = [
            'open' => 'bg-secondary',
            'in_progress' => 'bg-warning',
            'done' => 'bg-success',
            'archived' => 'bg-dark',
        ];
        $itemStatusBadges = [
            'open' => 'bg-secondary',
            'done' => 'bg-success',
        ];
        $weekdayLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $query = request()->query();
    @endphp

    <div class="page-wrapper">
        @include('admin.layouts.sidebar')

        <div class="page-content">
            @include('admin.layouts.page-header')

            <div class="main-container">
                @include('admin.layouts.alerts')

                <div class="row gutters">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2">
                                <div>
                                    <div class="text-muted">Monthly Planner</div>
                                    <div class="h5 mb-0">
                                        {{ $monthStart->format('F Y') }}
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-outline-secondary"
                                        href="{{ route('admin.personal.monthly-planner.show', ['year' => $prevMonth->year, 'month' => $prevMonth->month] + $query) }}">
                                        Prev
                                    </a>
                                    <a class="btn btn-outline-secondary"
                                        href="{{ route('admin.personal.monthly-planner.show', ['year' => $nextMonth->year, 'month' => $nextMonth->month] + $query) }}">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="GET" class="mt-3">
                    <div class="row gutters align-items-end">
                        <div class="form-group col-md-3">
                            <label for="category_id">Category</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">All</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ (int) ($filters['category_id'] ?? 0) === $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="quadrant">Quadrant</label>
                            <select class="form-control" id="quadrant" name="quadrant">
                                <option value="">All</option>
                                @foreach ($quadrantOptions as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ ($filters['quadrant'] ?? '') === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">All</option>
                                @foreach ($statusOptions as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ ($filters['status'] ?? '') === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="stars_min">Min Stars</label>
                            <select class="form-control" id="stars_min" name="stars_min">
                                <option value="">Any</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ ($filters['stars_min'] ?? '') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Include</label>
                            <div class="d-flex flex-wrap gap-2">
                                <input type="hidden" name="include_items" value="0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="include_items" name="include_items"
                                        value="1" {{ ($filters['include_items'] ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="include_items">Items</label>
                                </div>
                                <input type="hidden" name="include_tasks" value="0">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="include_tasks" name="include_tasks"
                                        value="1" {{ ($filters['include_tasks'] ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="include_tasks">Tasks</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-1 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Apply</button>
                            <a href="{{ route('admin.personal.monthly-planner.show', ['year' => $monthStart->year, 'month' => $monthStart->month]) }}"
                                class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <div class="row gutters mt-3">
                    <div class="col-lg-9">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Month Grid</div>
                            </div>
                            <div class="card-body">
                                <div class="month-grid">
                                    <div class="month-week month-weekdays">
                                        @foreach ($weekdayLabels as $label)
                                            <div class="weekday-label">{{ $label }}</div>
                                        @endforeach
                                    </div>

                                    @foreach ($days->chunk(7) as $week)
                                        <div class="month-week">
                                            @foreach ($week as $day)
                                                @php
                                                    $dateKey = $day->toDateString();
                                                    $dayItems = $itemsByDate->get($dateKey, collect());
                                                    $dayTasks = $tasksByDate->get($dateKey, collect());
                                                    $isOutside = $day->month !== $monthStart->month;
                                                    $displayItems = $dayItems->take(2);
                                                    $displayTasks = $dayTasks->take(2);
                                                @endphp
                                                <div class="month-day {{ $isOutside ? 'is-muted' : '' }}">
                                                    <div class="day-header">
                                                        <span class="day-number">{{ $day->format('j') }}</span>
                                                        <button type="button" class="btn btn-sm btn-link p-0 js-open-day"
                                                            data-date="{{ $dateKey }}">
                                                            Details
                                                        </button>
                                                    </div>

                                                    @if ($displayItems->isNotEmpty())
                                                        <div class="day-section-title">Items</div>
                                                        @foreach ($displayItems as $item)
                                                            @php $parent = $item->task; @endphp
                                                            <div class="day-entry">
                                                                <div class="entry-title">{{ Str::limit($item->title, 24) }}</div>
                                                                @if ($parent)
                                                                    <div class="entry-subtitle text-muted">
                                                                        {{ Str::limit($parent->title, 22) }}
                                                                    </div>
                                                                    <div class="entry-badges">
                                                                        <span class="badge {{ $quadrantBadges[$parent->quadrant] ?? 'bg-secondary' }}">
                                                                            {{ $quadrantOptions[$parent->quadrant] ?? $parent->quadrant }}
                                                                        </span>
                                                                        <span class="badge bg-light text-dark border">Star {{ $parent->stars }}</span>
                                                                        <span class="badge {{ $itemStatusBadges[$item->status] ?? 'bg-secondary' }}">
                                                                            {{ ucfirst($item->status) }}
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                        @if ($dayItems->count() > $displayItems->count())
                                                            <div class="text-muted small">+{{ $dayItems->count() - $displayItems->count() }} more</div>
                                                        @endif
                                                    @endif

                                                    @if ($displayTasks->isNotEmpty())
                                                        <div class="day-section-title">Tasks</div>
                                                        @foreach ($displayTasks as $task)
                                                            <div class="day-entry">
                                                                <div class="entry-title">{{ Str::limit($task->title, 24) }}</div>
                                                                <div class="entry-badges">
                                                                    <span class="badge {{ $quadrantBadges[$task->quadrant] ?? 'bg-secondary' }}">
                                                                        {{ $quadrantOptions[$task->quadrant] ?? $task->quadrant }}
                                                                    </span>
                                                                    <span class="badge bg-light text-dark border">Star {{ $task->stars }}</span>
                                                                    <span class="badge {{ $statusBadges[$task->status] ?? 'bg-secondary' }}">
                                                                        {{ $statusOptions[$task->status] ?? $task->status }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        @if ($dayTasks->count() > $displayTasks->count())
                                                            <div class="text-muted small">+{{ $dayTasks->count() - $displayTasks->count() }} more</div>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Month Summary</div>
                            </div>
                            <div class="card-body">
                                <div class="text-muted">Scheduled Items</div>
                                <div class="h5">{{ $counts['scheduled_items'] ?? 0 }}</div>
                                <div class="text-muted">Done Items</div>
                                <div class="h5 mb-3">{{ $counts['done_items'] ?? 0 }}</div>
                                <div class="text-muted">Scheduled Tasks</div>
                                <div class="h5">{{ $counts['scheduled_tasks'] ?? 0 }}</div>
                                <div class="text-muted">Done Tasks</div>
                                <div class="h5">{{ $counts['done_tasks'] ?? 0 }}</div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="card-title">Unscheduled Items</div>
                            </div>
                            <div class="card-body">
                                @forelse ($unscheduledItems->take(8) as $item)
                                    <div class="unscheduled-item">
                                        <div class="fw-bold">{{ $item->title }}</div>
                                        <div class="text-muted small">{{ $item->task?->title }}</div>
                                        <form method="POST"
                                            action="{{ route('admin.personal.weekly-planner.schedule-item', [$item->todo_task_id, $item->id]) }}"
                                            class="mt-2">
                                            @csrf
                                            <input type="date" class="form-control form-control-sm" name="scheduled_date"
                                                min="{{ $monthStart->toDateString() }}" max="{{ $monthEnd->toDateString() }}" required>
                                            <button type="submit" class="btn btn-sm btn-outline-primary mt-2">Schedule</button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="text-muted">No unscheduled items.</div>
                                @endforelse
                                @if ($unscheduledItems->count() > 8)
                                    <div class="text-muted small">+{{ $unscheduledItems->count() - 8 }} more</div>
                                @endif
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <div class="card-title">Unscheduled Tasks</div>
                            </div>
                            <div class="card-body">
                                @forelse ($unscheduledTasks->take(8) as $task)
                                    <div class="unscheduled-item">
                                        <div class="fw-bold">{{ $task->title }}</div>
                                        <form method="POST" action="{{ route('admin.personal.weekly-planner.schedule') }}" class="mt-2">
                                            @csrf
                                            <input type="hidden" name="todo_task_id" value="{{ $task->id }}">
                                            <input type="date" class="form-control form-control-sm" name="scheduled_date"
                                                min="{{ $monthStart->toDateString() }}" max="{{ $monthEnd->toDateString() }}" required>
                                            <button type="submit" class="btn btn-sm btn-outline-primary mt-2">Schedule</button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="text-muted">No unscheduled tasks.</div>
                                @endforelse
                                @if ($unscheduledTasks->count() > 8)
                                    <div class="text-muted small">+{{ $unscheduledTasks->count() - 8 }} more</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="monthlyDayModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Day Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <div class="text-muted">Selected date</div>
                                    <div class="h6 mb-0" id="monthlyDayLabel">-</div>
                                </div>

                                <div class="row gutters">
                                    <div class="col-md-6">
                                        <div class="fw-bold mb-2">Scheduled Items</div>
                                        <div id="monthlyDayItems"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bold mb-2">Scheduled Tasks</div>
                                        <div id="monthlyDayTasks"></div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row gutters">
                                    <div class="col-md-6">
                                        <div class="fw-bold mb-2">Quick Schedule Item</div>
                                        <form method="POST" id="monthlyScheduleItemForm"
                                            data-action-template="{{ route('admin.personal.weekly-planner.schedule-item', ['todo_task' => '__TASK__', 'item' => '__ITEM__']) }}">
                                            @csrf
                                            <input type="hidden" name="scheduled_date" id="monthlyScheduleItemDate">
                                            <select class="form-control mb-2" id="monthlyScheduleItemId" required>
                                                <option value="">Choose item</option>
                                                @foreach ($unscheduledItems as $item)
                                                    <option value="{{ $item->id }}" data-task-id="{{ $item->todo_task_id }}">
                                                        {{ $item->title }} ({{ $item->task?->title }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Schedule</button>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fw-bold mb-2">Quick Schedule Task</div>
                                        <form method="POST" action="{{ route('admin.personal.weekly-planner.schedule') }}">
                                            @csrf
                                            <input type="hidden" name="scheduled_date" id="monthlyScheduleTaskDate">
                                            <select class="form-control mb-2" name="todo_task_id" required>
                                                <option value="">Choose task</option>
                                                @foreach ($unscheduledTasks as $task)
                                                    <option value="{{ $task->id }}">{{ $task->title }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Schedule</button>
                                        </form>
                                    </div>
                                </div>

                                <hr>

                                <div class="row gutters">
                                    <div class="col-md-12">
                                        <div class="fw-bold mb-2">Quick Create Task Item</div>
                                        <form method="POST" id="monthlyCreateItemForm"
                                            data-action-template="{{ route('admin.personal.todo-task-items.store', ['todo_task' => '__TASK__']) }}">
                                            @csrf
                                            <input type="hidden" name="scheduled_date" id="monthlyCreateItemDate">
                                            <div class="row gutters">
                                                <div class="form-group col-md-5">
                                                    <label class="small text-muted">Parent Task</label>
                                                    <select class="form-control" id="monthlyCreateItemTask" required>
                                                        <option value="">Choose task</option>
                                                        @foreach ($parentTasks as $task)
                                                            <option value="{{ $task->id }}">{{ $task->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="small text-muted">Title</label>
                                                    <input type="text" class="form-control" name="title" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="small text-muted">Status</label>
                                                    <select class="form-control" name="status">
                                                        @foreach (\App\Models\TodoTaskItem::statusOptions() as $value => $label)
                                                            <option value="{{ $value }}">{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-12 text-right">
                                                    <button type="submit" class="btn btn-primary btn-sm">Create Item</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="text-muted small mt-2">
                                            Tip: created items inherit quadrant and stars from the parent task.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('custom-css-scripts')
    <style>
        .month-grid {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .month-week {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: 8px;
        }

        .month-weekdays .weekday-label {
            text-align: center;
            font-weight: 600;
            color: #6c757d;
        }

        .month-day {
            background: #f8f9fa;
            border: 1px solid #e4e7eb;
            border-radius: 8px;
            padding: 8px;
            min-height: 140px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .month-day.is-muted {
            opacity: 0.6;
        }

        .day-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .day-number {
            font-weight: 600;
        }

        .day-section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #6c757d;
            letter-spacing: 0.04em;
        }

        .day-entry {
            background: #fff;
            border-radius: 6px;
            padding: 6px;
            border: 1px solid #edf0f2;
        }

        .entry-title {
            font-weight: 600;
            font-size: 0.85rem;
        }

        .entry-subtitle {
            font-size: 0.75rem;
        }

        .entry-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-top: 4px;
        }

        .unscheduled-item {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .unscheduled-item:last-child {
            border-bottom: none;
        }
    </style>
@endpush

@push('custom-js-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dayPayloads = @json($dayPayloads);
            const quadrantLabels = @json($quadrantOptions);
            const taskStatusLabels = @json($statusOptions);
            const itemStatusLabels = @json(\App\Models\TodoTaskItem::statusOptions());
            const dayLabel = document.getElementById('monthlyDayLabel');
            const itemsContainer = document.getElementById('monthlyDayItems');
            const tasksContainer = document.getElementById('monthlyDayTasks');
            const modalEl = document.getElementById('monthlyDayModal');
            const scheduleItemForm = document.getElementById('monthlyScheduleItemForm');
            const scheduleItemSelect = document.getElementById('monthlyScheduleItemId');
            const scheduleItemDate = document.getElementById('monthlyScheduleItemDate');
            const scheduleTaskDate = document.getElementById('monthlyScheduleTaskDate');
            const createItemForm = document.getElementById('monthlyCreateItemForm');
            const createItemTask = document.getElementById('monthlyCreateItemTask');
            const createItemDate = document.getElementById('monthlyCreateItemDate');

            const escapeHtml = (value) => {
                if (!value) {
                    return '';
                }
                return value
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/\"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            };

            const renderBadges = (badges) => {
                return badges.map((badge) => {
                    return `<span class="badge ${badge.className}">${escapeHtml(badge.label)}</span>`;
                }).join('');
            };

            const renderItems = (items) => {
                if (!items.length) {
                    return '<div class="text-muted small">No items scheduled.</div>';
                }
                return items.map((item) => {
                    const parent = item.task || {};
                    const badges = [];
                    if (parent.quadrant) {
                        badges.push({
                            label: quadrantLabels[parent.quadrant] || parent.quadrant,
                            className: 'bg-secondary'
                        });
                    }
                    if (parent.stars) {
                        badges.push({
                            label: `Star ${parent.stars}`,
                            className: 'bg-light text-dark border'
                        });
                    }
                    badges.push({
                        label: itemStatusLabels[item.status] || item.status,
                        className: 'bg-secondary'
                    });

                    return `
                        <div class="day-entry mb-2">
                            <div class="entry-title">${escapeHtml(item.title)}</div>
                            ${parent.title ? `<div class="entry-subtitle text-muted">${escapeHtml(parent.title)}</div>` : ''}
                            <div class="entry-badges">${renderBadges(badges)}</div>
                        </div>
                    `;
                }).join('');
            };

            const renderTasks = (tasks) => {
                if (!tasks.length) {
                    return '<div class="text-muted small">No tasks scheduled.</div>';
                }
                return tasks.map((task) => {
                    const badges = [
                        {
                            label: quadrantLabels[task.quadrant] || task.quadrant,
                            className: 'bg-secondary'
                        },
                        {
                            label: `Star ${task.stars}`,
                            className: 'bg-light text-dark border'
                        },
                        {
                            label: taskStatusLabels[task.status] || task.status,
                            className: 'bg-secondary'
                        }
                    ];
                    return `
                        <div class="day-entry mb-2">
                            <div class="entry-title">${escapeHtml(task.title)}</div>
                            <div class="entry-badges">${renderBadges(badges)}</div>
                        </div>
                    `;
                }).join('');
            };

            const updateScheduleItemAction = () => {
                if (!scheduleItemForm || !scheduleItemSelect) {
                    return;
                }
                const selectedOption = scheduleItemSelect.options[scheduleItemSelect.selectedIndex];
                const taskId = selectedOption ? selectedOption.dataset.taskId : '';
                const itemId = scheduleItemSelect.value;
                const template = scheduleItemForm.dataset.actionTemplate || '';
                scheduleItemForm.action = template
                    .replace('__TASK__', taskId || '')
                    .replace('__ITEM__', itemId || '');
            };

            const updateCreateItemAction = () => {
                if (!createItemForm || !createItemTask) {
                    return;
                }
                const taskId = createItemTask.value;
                const template = createItemForm.dataset.actionTemplate || '';
                createItemForm.action = template.replace('__TASK__', taskId || '');
            };

            document.querySelectorAll('.js-open-day').forEach((button) => {
                button.addEventListener('click', function() {
                    const dateKey = button.dataset.date;
                    const payload = dayPayloads[dateKey] || { items: [], tasks: [] };
                    if (dayLabel) {
                        dayLabel.textContent = dateKey;
                    }
                    if (itemsContainer) {
                        itemsContainer.innerHTML = renderItems(payload.items || []);
                    }
                    if (tasksContainer) {
                        tasksContainer.innerHTML = renderTasks(payload.tasks || []);
                    }
                    if (scheduleItemDate) {
                        scheduleItemDate.value = dateKey;
                    }
                    if (scheduleTaskDate) {
                        scheduleTaskDate.value = dateKey;
                    }
                    if (createItemDate) {
                        createItemDate.value = dateKey;
                    }
                    updateScheduleItemAction();
                    updateCreateItemAction();

                    if (window.bootstrap && bootstrap.Modal) {
                        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                        modal.show();
                    } else if (modalEl) {
                        modalEl.classList.add('show');
                        modalEl.style.display = 'block';
                    }
                });
            });

            if (scheduleItemSelect) {
                scheduleItemSelect.addEventListener('change', updateScheduleItemAction);
            }

            if (createItemTask) {
                createItemTask.addEventListener('change', updateCreateItemAction);
            }
        });
    </script>
@endpush
