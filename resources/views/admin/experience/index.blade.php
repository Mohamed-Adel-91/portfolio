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
                                <div class="card-title mb-0">Experience</div>
                                <a class="btn btn-primary" href="{{ route('admin.experience.create') }}">
                                    <i class="icon-plus-circle mr-1"></i>Add Experience
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table custom-table m-0">
                                        <thead>
                                            <tr>
                                                <th>Company</th>
                                                <th>Title</th>
                                                <th>Work Type</th>
                                                <th>Period</th>
                                                <th>Logo</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($experiences as $experience)
                                                <tr>
                                                    <td>{{ $experience->co_name }}</td>
                                                    <td>{{ $experience->title }}</td>
                                                    <td>{{ $experience->work_type ?? 'N/A' }}</td>
                                                    <td>
                                                        {{ $experience->start_at?->format('M Y') ?? 'N/A' }}
                                                        -
                                                        {{ $experience->end_at?->format('M Y') ?? 'Present' }}
                                                    </td>
                                                    <td>
                                                        @if ($experience->logo_path)
                                                            <img src="{{ asset($experience->logo_path) }}" alt="{{ $experience->title }}"
                                                                class="img-thumbnail" style="height: 50px; width: 50px;">
                                                        @else
                                                            <span class="text-muted">No image</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="td-actions">
                                                            <a href="{{ route('admin.experience.edit', $experience) }}" class="icon green"
                                                                data-toggle="tooltip" title="Edit">
                                                                <i class="icon-edit"></i>
                                                            </a>
                                                            <form method="POST" action="{{ route('admin.experience.destroy', $experience) }}"
                                                                class="d-inline"
                                                                onsubmit="return confirm('Delete this experience? This action cannot be undone.');">
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
                                                    <td colspan="6" class="text-center">No experience records found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($experiences->hasPages())
                                    @include('admin.partials.pagination', ['data' => $experiences])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
