@extends('admin.layouts.master')

@section('content')
    @php
        $statusBadges = [
            'open' => 'bg-secondary',
            'in_progress' => 'bg-warning',
            'done' => 'bg-success',
            'archived' => 'bg-dark',
        ];
        $quadrantBadges = [
            'do' => 'bg-success',
            'defer' => 'bg-info',
            'delegate' => 'bg-primary',
            'delete' => 'bg-danger',
        ];
        $today = \Carbon\Carbon::now(config('app.timezone'))->toDateString();
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
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-title mb-0">Todo Tasks</div>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-primary" href="{{ route('admin.personal.todo-tasks.create') }}">
                                        <i class="icon-plus-circle mr-1"></i>Add Task
                                    </a>
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#quickAddTaskModal">
                                        Quick Add
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="GET" class="mb-3">
                                    <div class="row gutters">
                                        <div class="form-group col-md-3">
                                            <label for="search">Search</label>
                                            <input type="text" class="form-control" id="search" name="search"
                                                value="{{ $filters['search'] ?? '' }}" placeholder="Title or description">
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
                                            <label for="category">Category</label>
                                            <select class="form-control" id="category" name="category">
                                                <option value="">All</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ (int) ($filters['category'] ?? 0) === $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="quadrant">4D Quadrant</label>
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
                                        <div class="form-group col-md-1">
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
                                            <label for="scheduled">Scheduled</label>
                                            <select class="form-control" id="scheduled" name="scheduled">
                                                <option value="">All</option>
                                                <option value="1" {{ ($filters['scheduled'] ?? '') === '1' ? 'selected' : '' }}>Scheduled</option>
                                                <option value="0" {{ ($filters['scheduled'] ?? '') === '0' ? 'selected' : '' }}>Unscheduled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row gutters">
                                        <div class="form-group col-md-2">
                                            <label for="due_from">Due From</label>
                                            <input type="date" class="form-control" id="due_from" name="due_from"
                                                value="{{ $filters['due_from'] ?? '' }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="due_to">Due To</label>
                                            <input type="date" class="form-control" id="due_to" name="due_to"
                                                value="{{ $filters['due_to'] ?? '' }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="sort">Sort</label>
                                            <select class="form-control" id="sort" name="sort">
                                                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest</option>
                                                <option value="due_date" {{ $sort === 'due_date' ? 'selected' : '' }}>Due Date</option>
                                                <option value="stars_desc" {{ $sort === 'stars_desc' ? 'selected' : '' }}>Stars (High)</option>
                                                <option value="sort_order" {{ $sort === 'sort_order' ? 'selected' : '' }}>Manual Order</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary mr-2">Filter</button>
                                            <a href="{{ route('admin.personal.todo-tasks.index') }}" class="btn btn-outline-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('admin.personal.todo-tasks.bulk') }}" id="tasksActionForm">
                                    @csrf
                                    <div class="row gutters align-items-end mb-3">
                                        <div class="form-group col-md-3">
                                            <label for="bulk_action">Bulk Action</label>
                                            <select class="form-control" id="bulk_action" name="bulk_action">
                                                <option value="">Choose action</option>
                                                <option value="mark_done">Mark Done</option>
                                                <option value="mark_open">Mark Open</option>
                                                <option value="set_quadrant">Change Quadrant</option>
                                                <option value="set_category">Change Category</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3" id="bulkQuadrantGroup" style="display: none;">
                                            <label for="bulk_quadrant">Quadrant</label>
                                            <select class="form-control" id="bulk_quadrant" name="bulk_quadrant">
                                                <option value="">Select quadrant</option>
                                                @foreach ($quadrantOptions as $value => $label)
                                                    <option value="{{ $value }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3" id="bulkCategoryGroup" style="display: none;">
                                            <label for="bulk_category_id">Category</label>
                                            <select class="form-control" id="bulk_category_id" name="bulk_category_id">
                                                <option value="">No Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button type="submit" class="btn btn-primary">Apply</button>
                                            <button type="submit" class="btn btn-outline-secondary" formaction="{{ route('admin.personal.todo-tasks.reorder') }}">
                                                Save Order
                                            </button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table custom-table m-0">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" id="selectAllTasks">
                                                    </th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>4D</th>
                                                    <th>Stars</th>
                                                    <th>Status</th>
                                                    <th>Due</th>
                                                    <th>Scheduled</th>
                                                    <th>Order</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($tasks as $task)
                                                    @php
                                                        $rowClass = '';
                                                        if ($task->status === 'done') {
                                                            $rowClass = 'table-success';
                                                        } elseif ($task->due_date) {
                                                            $dueDate = $task->due_date->toDateString();
                                                            if ($dueDate < $today) {
                                                                $rowClass = 'table-danger';
                                                            } elseif ($dueDate === $today) {
                                                                $rowClass = 'table-warning';
                                                            }
                                                        }
                                                    @endphp
                                                    <tr class="{{ $rowClass }}">
                                                        <td>
                                                            <input type="checkbox" name="task_ids[]" value="{{ $task->id }}">
                                                        </td>
                                                        <td>
                                                            <div class="fw-bold">{{ $task->title }}</div>
                                                            @if ($task->description)
                                                                <div class="text-muted small">{{ Str::limit($task->description, 80) }}</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($task->category)
                                                                <span class="badge"
                                                                    style="background-color: {{ $task->category->badge_color }}; color: #fff;">
                                                                    {{ $task->category->name }}
                                                                </span>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="badge {{ $quadrantBadges[$task->quadrant] ?? 'bg-secondary' }}">
                                                                {{ $quadrantOptions[$task->quadrant] ?? $task->quadrant }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i class="bi bi-star-fill {{ $i <= $task->stars ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                        </td>
                                                        <td>
                                                            <span class="badge {{ $statusBadges[$task->status] ?? 'bg-secondary' }}">
                                                                {{ $statusOptions[$task->status] ?? $task->status }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $task->due_date ? $task->due_date->toDateString() : '-' }}</td>
                                                        <td>{{ $task->scheduled_date ? $task->scheduled_date->toDateString() : '-' }}</td>
                                                        <td style="max-width: 90px;">
                                                            <input type="number" class="form-control form-control-sm"
                                                                name="order[{{ $task->id }}]" min="0" value="{{ $task->sort_order }}">
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex flex-wrap gap-1 justify-content-center">
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
                                                                <form method="POST" action="{{ route('admin.personal.todo-tasks.destroy', $task) }}"
                                                                    onsubmit="return confirm('Delete this task?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center">No tasks found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </form>

                                @if ($tasks->hasPages())
                                    @include('admin.partials.pagination', ['data' => $tasks])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="quickAddTaskModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.personal.todo-tasks.store') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Quick Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-control" name="todo_category_id">
                            <option value="">No Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">4D Quadrant</label>
                        <select class="form-control" name="quadrant">
                            @foreach ($quadrantOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Importance</label>
                        <div class="star-rating" data-star-group="quick-add">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="quick-stars-{{ $i }}" name="stars" value="{{ $i }}"
                                    {{ $i === 3 ? 'checked' : '' }}>
                                <label for="quick-stars-{{ $i }}">
                                    <i class="bi bi-star-fill"></i>
                                </label>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Task</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom-css-scripts')
    <style>
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
            font-size: 1.2rem;
        }

        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f5b301;
        }
    </style>
@endpush

@push('custom-js-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAllTasks');
            const checkboxes = document.querySelectorAll('input[name="task_ids[]"]');
            const bulkAction = document.getElementById('bulk_action');
            const bulkQuadrantGroup = document.getElementById('bulkQuadrantGroup');
            const bulkCategoryGroup = document.getElementById('bulkCategoryGroup');

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach((checkbox) => {
                        checkbox.checked = selectAll.checked;
                    });
                });
            }

            const toggleBulkFields = () => {
                const value = bulkAction ? bulkAction.value : '';
                if (bulkQuadrantGroup) {
                    bulkQuadrantGroup.style.display = value === 'set_quadrant' ? 'block' : 'none';
                }
                if (bulkCategoryGroup) {
                    bulkCategoryGroup.style.display = value === 'set_category' ? 'block' : 'none';
                }
            };

            if (bulkAction) {
                bulkAction.addEventListener('change', toggleBulkFields);
                toggleBulkFields();
            }
        });
    </script>
@endpush
