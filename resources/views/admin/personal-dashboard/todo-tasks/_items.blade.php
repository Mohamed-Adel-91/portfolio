@php
    $itemStatusBadges = [
        'open' => 'bg-secondary',
        'done' => 'bg-success',
    ];
@endphp

<div class="card mt-3">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div class="card-title mb-0">Subtasks</div>
        @if ($task->hasRange())
            <form method="POST" action="{{ route('admin.personal.todo-tasks.split-items', $task) }}"
                class="d-flex flex-wrap gap-2 align-items-center">
                @csrf
                <input type="hidden" name="include_weekends" value="0">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="include_weekends" name="include_weekends" value="1" checked>
                    <label class="form-check-label small" for="include_weekends">Include weekends</label>
                </div>
                <button type="submit" class="btn btn-sm btn-outline-primary">Split into daily items</button>
            </form>
        @endif
    </div>
    <div class="card-body">
        @if (! $task->hasRange())
            <div class="text-muted small mb-3">Set a start and end date to split this task into daily items.</div>
        @endif

        @forelse ($task->items as $item)
            <div class="border rounded p-2 mb-3">
                <div class="d-flex flex-wrap justify-content-between gap-2">
                    <div>
                        <div class="fw-bold">{{ $item->title }}</div>
                        @if ($item->description)
                            <div class="text-muted small">{{ $item->description }}</div>
                        @endif
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            <span class="badge {{ $itemStatusBadges[$item->status] ?? 'bg-secondary' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                            <span class="badge bg-light text-dark border">
                                {{ $item->scheduled_date ? $item->scheduled_date->toDateString() : 'Not scheduled' }}
                            </span>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 align-items-start">
                        @if ($item->status === 'done')
                            <form method="POST" action="{{ route('admin.personal.todo-task-items.mark-open', [$task, $item]) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-secondary">Mark Open</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.personal.todo-task-items.mark-done', [$task, $item]) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success">Mark Done</button>
                            </form>
                        @endif
                        @if ($item->scheduled_date)
                            <form method="POST" action="{{ route('admin.personal.todo-task-items.unschedule', [$task, $item]) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-warning">Unschedule</button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('admin.personal.todo-task-items.destroy', [$task, $item]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.personal.todo-task-items.update', [$task, $item]) }}" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="row gutters align-items-end">
                        <div class="form-group col-md-4">
                            <label class="small text-muted">Title</label>
                            <input type="text" class="form-control form-control-sm" name="title" value="{{ old('title', $item->title) }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="small text-muted">Description</label>
                            <input type="text" class="form-control form-control-sm" name="description"
                                value="{{ old('description', $item->description) }}">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="small text-muted">Status</label>
                            <select class="form-control form-control-sm" name="status">
                                @foreach (\App\Models\TodoTaskItem::statusOptions() as $value => $label)
                                    <option value="{{ $value }}" {{ $item->status === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="small text-muted">Scheduled</label>
                            <input type="date" class="form-control form-control-sm" name="scheduled_date"
                                value="{{ old('scheduled_date', optional($item->scheduled_date)->toDateString()) }}">
                        </div>
                        <div class="form-group col-md-1">
                            <label class="small text-muted">Order</label>
                            <input type="number" class="form-control form-control-sm" name="sort_order" min="0"
                                value="{{ old('sort_order', $item->sort_order) }}">
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        @empty
            <div class="text-muted">No subtasks yet.</div>
        @endforelse

        <div class="mt-4">
            <h6 class="mb-2">Quick Add</h6>
            <form method="POST" action="{{ route('admin.personal.todo-task-items.store', $task) }}">
                @csrf
                <div class="row gutters">
                    <div class="form-group col-md-4">
                        <label for="item-title-{{ $task->id }}">Title</label>
                        <input type="text" class="form-control" id="item-title-{{ $task->id }}" name="title" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="item-description-{{ $task->id }}">Description</label>
                        <input type="text" class="form-control" id="item-description-{{ $task->id }}" name="description">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="item-status-{{ $task->id }}">Status</label>
                        <select class="form-control" id="item-status-{{ $task->id }}" name="status">
                            @foreach (\App\Models\TodoTaskItem::statusOptions() as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="item-scheduled-{{ $task->id }}">Scheduled</label>
                        <input type="date" class="form-control" id="item-scheduled-{{ $task->id }}" name="scheduled_date">
                    </div>
                    <div class="form-group col-12 text-right">
                        <button type="submit" class="btn btn-primary">Add Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
