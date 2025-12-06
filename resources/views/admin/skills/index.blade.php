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
                                <div class="card-title mb-0">Skills</div>
                                <a class="btn btn-primary" href="{{ route('admin.skills.create') }}">
                                    <i class="icon-plus-circle mr-1"></i>Add Skill
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table custom-table m-0">
                                        <thead>
                                            <tr>
                                                <th>Logo</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Progress</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($skills as $skill)
                                                <tr>
                                                    <td>
                                                        @if ($skill->logo_path)
                                                            <img src="{{ asset($skill->logo_path) }}" alt="{{ $skill->name }} logo"
                                                                class="img-thumbnail" style="height: 40px; width: 40px; object-fit: contain;">
                                                        @else
                                                            <span class="text-muted">No logo</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $skill->name }}</td>
                                                    <td>{{ $skill->type ?? 'N/A' }}</td>
                                                    <td>{{ $skill->progress }}%</td>
                                                    <td class="text-center">
                                                        <div class="td-actions">
                                                            <a href="{{ route('admin.skills.edit', $skill) }}" class="icon green"
                                                                data-toggle="tooltip" title="Edit">
                                                                <i class="icon-edit"></i>
                                                            </a>
                                                            <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}"
                                                                class="d-inline"
                                                                onsubmit="return confirm('Delete this skill? This action cannot be undone.');">
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
                                                    <td colspan="4" class="text-center">No skills found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($skills->hasPages())
                                    @include('admin.partials.pagination', ['data' => $skills])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
