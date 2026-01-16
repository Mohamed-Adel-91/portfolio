@php
    $currentStars = (int) old('stars', $task->stars ?? 3);
@endphp

<div class="row gutters">
    <div class="form-group col-md-8">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}" required>
        @error('title')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="todo_category_id">Category</label>
        <select class="form-control" id="todo_category_id" name="todo_category_id">
            <option value="">No Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ (int) old('todo_category_id', $task->todo_category_id) === $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('todo_category_id')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="quadrant">4D Quadrant</label>
        <select class="form-control" id="quadrant" name="quadrant">
            @foreach ($quadrantOptions as $value => $label)
                <option value="{{ $value }}" {{ old('quadrant', $task->quadrant) === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <small class="text-muted">Do it, defer it, delegate it, or delete it.</small>
        @error('quadrant')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            @foreach ($statusOptions as $value => $label)
                <option value="{{ $value }}" {{ old('status', $task->status) === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('status')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="sort_order">Sort Order</label>
        <input type="number" class="form-control" id="sort_order" name="sort_order" min="0"
            value="{{ old('sort_order', $task->sort_order ?? 0) }}">
        @error('sort_order')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label>Importance</label>
        <div class="star-rating">
            @for ($i = 5; $i >= 1; $i--)
                <input type="radio" id="stars-{{ $i }}" name="stars" value="{{ $i }}"
                    {{ $currentStars === $i ? 'checked' : '' }}>
                <label for="stars-{{ $i }}" title="{{ $i }} stars">
                    <i class="bi bi-star-fill"></i>
                </label>
            @endfor
        </div>
        <small class="text-muted">1 = low, 5 = high</small>
        @error('stars')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-3">
        <label for="due_date">Due Date</label>
        <input type="date" class="form-control" id="due_date" name="due_date"
            value="{{ old('due_date', optional($task->due_date)->toDateString()) }}">
        @error('due_date')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-3">
        <label for="scheduled_date">Scheduled Date</label>
        <input type="date" class="form-control" id="scheduled_date" name="scheduled_date"
            value="{{ old('scheduled_date', optional($task->scheduled_date)->toDateString()) }}">
        @error('scheduled_date')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-3">
        <label for="start_date">Start Date</label>
        <input type="date" class="form-control" id="start_date" name="start_date"
            value="{{ old('start_date', optional($task->start_date)->toDateString()) }}">
        @error('start_date')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-3">
        <label for="end_date">End Date</label>
        <input type="date" class="form-control" id="end_date" name="end_date"
            value="{{ old('end_date', optional($task->end_date)->toDateString()) }}">
        <small class="text-muted">Use range for multi-day outcomes; schedule daily work using Subtasks.</small>
        @error('end_date')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-12">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $task->description) }}</textarea>
        @error('description')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">{{ $submitLabel ?? 'Save' }}</button>
    </div>
</div>

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
