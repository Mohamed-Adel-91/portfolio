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
                                <div class="card-title mb-0">Projects</div>
                                <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">
                                    <i class="icon-plus-circle mr-1"></i>Add Project
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table custom-table m-0">
                                        <thead>
                                            <tr>
                                                <th>Thumbnail</th>
                                                <th>Name</th>
                                                <th>URL</th>
                                                <th>Launched</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($projects as $project)
                                                <tr>
                                                    <td>
                                                        @if ($project->image_path)
                                                            <img src="{{ asset($project->image_path) }}" alt="{{ $project->name }}"
                                                                class="img-thumbnail" style="height: 50px; width: 50px;">
                                                        @else
                                                            <span class="text-muted">No image</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $project->name }}</td>
                                                    <td>
                                                        @if ($project->url)
                                                            <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer">
                                                                {{ $project->url }}
                                                            </a>
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $project->lunched_at?->format('M d, Y') ?? 'N/A' }}</td>
                                                    <td class="text-center">
                                                        <div class="td-actions">
                                                            <a href="{{ route('admin.projects.edit', $project) }}" class="icon green"
                                                                data-toggle="tooltip" title="Edit">
                                                                <i class="icon-edit"></i>
                                                            </a>
                                                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                                                                class="d-inline"
                                                                onsubmit="return confirm('Delete this project? This action cannot be undone.');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="icon red border-0 bg-transparent p-0"
                                                                    data-toggle="tooltip" title="Delete">
                                                                    <i class="icon-cancel"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No projects found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($projects->hasPages())
                                    @include('admin.partials.pagination', ['data' => $projects])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
