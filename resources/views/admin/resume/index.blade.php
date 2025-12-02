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
                                <div class="card-title mb-0">Resume</div>
                                <a class="btn btn-primary" href="{{ route('admin.resume.create') }}">
                                    <i class="icon-plus-circle mr-1"></i>Add Resume
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table custom-table m-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Head Title</th>
                                                <th>Title</th>
                                                <th>Sub Title</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($resumes as $resume)
                                                <tr>
                                                    <td>{{ $resume->id }}</td>
                                                    <td>{{ $resume->head_title }}</td>
                                                    <td>{{ $resume->title }}</td>
                                                    <td>{{ $resume->sub_title ?? 'N/A' }}</td>
                                                    <td class="text-center">
                                                        <div class="td-actions">
                                                            <a href="{{ route('admin.resume.edit', $resume) }}" class="icon green"
                                                                data-toggle="tooltip" title="Edit">
                                                                <i class="icon-edit"></i>
                                                            </a>
                                                            <form method="POST" action="{{ route('admin.resume.destroy', $resume) }}"
                                                                class="d-inline"
                                                                onsubmit="return confirm('Delete this resume entry? This action cannot be undone.');">
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
                                                    <td colspan="5" class="text-center">No resume records found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($resumes->hasPages())
                                    @include('admin.partials.pagination', ['data' => $resumes])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
