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
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted">Week Overview</div>
                                    <div class="h5 mb-0">
                                        {{ $weekStart->format('M d, Y') }} - {{ $weekEnd->format('M d, Y') }}
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <a class="btn btn-outline-secondary" href="{{ route('admin.personal.weekly-planner.show', $prevWeek) }}">Prev</a>
                                    <a class="btn btn-outline-secondary" href="{{ route('admin.personal.weekly-planner.show', $nextWeek) }}">Next</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gutters mt-3">
                    <div class="col-lg-8">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Weekly Focus</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($quadrantOptions as $value => $label)
                                        <span class="badge {{ $quadrantBadges[$value] ?? 'bg-secondary' }}">
                                            {{ $label }}: {{ $quadrantCounts[$value] ?? 0 }}
                                        </span>
                                    @endforeach
                                </div>
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    <span class="badge {{ $statusBadges['done'] }}">Done: {{ $doneCount }}</span>
                                    <span class="badge {{ $statusBadges['open'] }}">Open: {{ $openCount }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Quick Stats</div>
                            </div>
                            <div class="card-body">
                                <div class="text-muted">Scheduled tasks</div>
                                <div class="h4 mb-3">{{ $tasksByDay->flatten()->count() }}</div>
                                <div class="text-muted">Unscheduled tasks</div>
                                <div class="h4">{{ $unscheduledTasks->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gutters mt-3">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Weekly Planner</div>
                            </div>
                            <div class="card-body">
                                <div class="weekly-grid">
                                    @foreach ($days as $day)
                                        @php
                                            $dayKey = $day->toDateString();
                                            $dayTasks = $tasksByDay->get($dayKey, collect());
                                        @endphp
                                        <div class="weekly-day">
                                            <div class="day-header">
                                                <div class="fw-bold">{{ $day->format('l') }}</div>
                                                <div class="text-muted small">{{ $day->format('M d') }}</div>
                                            </div>
                                            <div class="day-tasks">
                                                @forelse ($dayTasks as $task)
                                                    <div class="day-task">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <div class="task-title">{{ $task->title }}</div>
                                                                <div class="task-meta">
                                                                    @if ($task->category)
                                                                        <span class="badge"
                                                                            style="background-color: {{ $task->category->badge_color }}; color: #fff;">
                                                                            {{ $task->category->name }}
                                                                        </span>
                                                                    @endif
                                                                    <span class="badge {{ $quadrantBadges[$task->quadrant] ?? 'bg-secondary' }}">
                                                                        {{ $quadrantOptions[$task->quadrant] ?? $task->quadrant }}
                                                                    </span>
                                                                    <span class="badge {{ $statusBadges[$task->status] ?? 'bg-secondary' }}">
                                                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                                    </span>
                                                                </div>
                                                                <div class="task-stars">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <i class="bi bi-star-fill {{ $i <= $task->stars ? 'text-warning' : 'text-muted' }}"></i>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <form method="POST" action="{{ route('admin.personal.weekly-planner.unschedule') }}">
                                                                @csrf
                                                                <input type="hidden" name="todo_task_id" value="{{ $task->id }}">
                                                                <button type="submit" class="btn btn-sm btn-light" title="Unschedule">
                                                                    <i class="bi bi-x-lg"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="task-actions mt-2">
                                                            <a href="{{ route('admin.personal.todo-tasks.edit', $task) }}"
                                                                class="btn btn-sm btn-outline-primary">Edit</a>
                                                            @if ($task->status === 'done')
                                                                <form method="POST" action="{{ route('admin.personal.todo-tasks.mark-open', $task) }}">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Mark Open</button>
                                                                </form>
                                                            @else
                                                                <form method="POST" action="{{ route('admin.personal.todo-tasks.mark-done', $task) }}">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm btn-outline-success">Mark Done</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="text-muted small">No tasks yet.</div>
                                                @endforelse
                                            </div>
                                            <form method="POST" action="{{ route('admin.personal.weekly-planner.schedule') }}" class="mt-2">
                                                @csrf
                                                <input type="hidden" name="scheduled_date" value="{{ $dayKey }}">
                                                <div class="input-group input-group-sm">
                                                    <select class="form-control" name="todo_task_id" required>
                                                        <option value="">Add existing task</option>
                                                        @foreach ($unscheduledTasks as $task)
                                                            <option value="{{ $task->id }}">{{ $task->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button class="btn btn-outline-primary" type="submit">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gutters mt-3">
                    <div class="col-lg-8">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Week Notes</div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.personal.weekly-planner.notes') }}">
                                    @csrf
                                    <input type="hidden" name="week_start_date" value="{{ $weekStart->toDateString() }}">
                                    <textarea name="notes" class="form-control" rows="8"
                                        placeholder="Capture weekly reflections, priorities, and outcomes...">{{ old('notes', $notes) }}</textarea>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save Notes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Unscheduled Tasks</div>
                            </div>
                            <div class="card-body">
                                @forelse ($unscheduledTasks as $task)
                                    <div class="unscheduled-item">
                                        <div class="fw-bold">{{ $task->title }}</div>
                                        <div class="task-meta">
                                            @if ($task->category)
                                                <span class="badge"
                                                    style="background-color: {{ $task->category->badge_color }}; color: #fff;">
                                                    {{ $task->category->name }}
                                                </span>
                                            @endif
                                            <span class="badge {{ $quadrantBadges[$task->quadrant] ?? 'bg-secondary' }}">
                                                {{ $quadrantOptions[$task->quadrant] ?? $task->quadrant }}
                                            </span>
                                        </div>
                                        <form method="POST" action="{{ route('admin.personal.weekly-planner.schedule') }}" class="mt-2">
                                            @csrf
                                            <input type="hidden" name="todo_task_id" value="{{ $task->id }}">
                                            <div class="input-group input-group-sm">
                                                <select class="form-control" name="scheduled_date" required>
                                                    <option value="">Pick day</option>
                                                    @foreach ($days as $day)
                                                        <option value="{{ $day->toDateString() }}">{{ $day->format('D M d') }}</option>
                                                    @endforeach
                                                </select>
                                                <button class="btn btn-outline-primary" type="submit">Schedule</button>
                                            </div>
                                        </form>
                                    </div>
                                @empty
                                    <div class="text-muted">No unscheduled tasks.</div>
                                @endforelse
                            </div>
                        </div>

                        <div class="card h-100 mt-3">
                            <div class="card-header">
                                <div class="card-title">Quick Create Task</div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.personal.todo-tasks.store') }}">
                                    @csrf
                                    <input type="hidden" name="redirect_back" value="1">
                                    <div class="mb-2">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Category</label>
                                        <select class="form-control" name="todo_category_id">
                                            <option value="">No Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Quadrant</label>
                                        <select class="form-control" name="quadrant">
                                            @foreach ($quadrantOptions as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Importance</label>
                                        <div class="star-rating">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="planner-stars-{{ $i }}" name="stars" value="{{ $i }}"
                                                    {{ $i === 3 ? 'checked' : '' }}>
                                                <label for="planner-stars-{{ $i }}">
                                                    <i class="bi bi-star-fill"></i>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Schedule For</label>
                                        <select class="form-control" name="scheduled_date">
                                            <option value="">Not scheduled</option>
                                            @foreach ($days as $day)
                                                <option value="{{ $day->toDateString() }}">{{ $day->format('D M d') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Create Task</button>
                                </form>
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
        .weekly-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 12px;
        }

        .weekly-day {
            background: #f8f9fa;
            border: 1px solid #e4e7eb;
            border-radius: 8px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            min-height: 260px;
        }

        .day-header {
            margin-bottom: 8px;
        }

        .day-tasks {
            flex: 1 1 auto;
        }

        .day-task {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 8px;
            margin-bottom: 8px;
        }

        .task-title {
            font-weight: 600;
        }

        .task-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-top: 4px;
        }

        .task-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .task-stars {
            margin-top: 4px;
        }

        .unscheduled-item {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .unscheduled-item:last-child {
            border-bottom: none;
        }

        .star-rating {
            display: inline-flex;
            flex-direction: row-reverse;
            gap: 4px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #d1d5db;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f5b301;
        }
    </style>
@endpush
