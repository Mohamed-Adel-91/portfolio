@extends('admin.layouts.master')

@section('content')
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
                                <div class="card-title mb-0">Todo Categories</div>
                                <a class="btn btn-primary" href="{{ route('admin.personal.todo-categories.create') }}">
                                    <i class="icon-plus-circle mr-1"></i>Add Category
                                </a>
                            </div>
                            <div class="card-body">
                                <form method="GET" class="mb-3">
                                    <div class="row gutters align-items-end">
                                        <div class="form-group col-md-5">
                                            <label for="search">Search</label>
                                            <input type="text" class="form-control" id="search" name="search"
                                                value="{{ $filters['search'] ?? '' }}" placeholder="Name, slug, or description">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="active">Status</label>
                                            <select class="form-control" id="active" name="active">
                                                <option value="">All</option>
                                                <option value="1" {{ ($filters['active'] ?? '') === '1' ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ ($filters['active'] ?? '') === '0' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <a href="{{ route('admin.personal.todo-categories.index') }}" class="btn btn-outline-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table custom-table m-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Color</th>
                                                <th>Status</th>
                                                <th>Tasks</th>
                                                <th>Order</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($categories as $category)
                                                <tr>
                                                    <td>
                                                        <div class="fw-bold">{{ $category->name }}</div>
                                                        @if ($category->description)
                                                            <div class="text-muted small">{{ $category->description }}</div>
                                                        @endif
                                                    </td>
                                                    <td>{{ $category->slug }}</td>
                                                    <td>
                                                        <span class="badge" style="background-color: {{ $category->badge_color }}; color: #fff;">
                                                            {{ $category->color ?? 'auto' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $category->tasks_count }}</td>
                                                    <td>{{ $category->sort_order }}</td>
                                                    <td class="text-center">
                                                        <div class="td-actions">
                                                            <a href="{{ route('admin.personal.todo-categories.edit', $category) }}" class="icon green"
                                                                data-toggle="tooltip" title="Edit">
                                                                <i class="icon-edit"></i>
                                                            </a>
                                                            <form method="POST" action="{{ route('admin.personal.todo-categories.destroy', $category) }}"
                                                                class="d-inline" onsubmit="return confirm('Delete this category?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="icon red border-0 bg-transparent p-0" title="Delete">
                                                                    <i class="icon-cancel"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No categories found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($categories->hasPages())
                                    @include('admin.partials.pagination', ['data' => $categories])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
