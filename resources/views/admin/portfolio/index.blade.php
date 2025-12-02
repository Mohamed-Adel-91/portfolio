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
                                <div class="card-title mb-0">Portfolio</div>
                                <a class="btn btn-primary" href="{{ route('admin.portfolio.create') }}">
                                    <i class="icon-plus-circle mr-1"></i>Add Portfolio Item
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table custom-table m-0">
                                        <thead>
                                            <tr>
                                                <th>Thumbnail</th>
                                                <th>Title</th>
                                                <th>Sub Title</th>
                                                <th>Project</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($portfolios as $portfolio)
                                                <tr>
                                                    <td>
                                                        @if ($portfolio->image_path)
                                                            <img src="{{ asset($portfolio->image_path) }}" alt="{{ $portfolio->title }}"
                                                                class="img-thumbnail" style="height: 50px; width: 50px;">
                                                        @else
                                                            <span class="text-muted">No image</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $portfolio->title }}</td>
                                                    <td>{{ $portfolio->sub_title ?? 'N/A' }}</td>
                                                    <td>{{ $portfolio->project?->name ?? 'N/A' }}</td>
                                                    <td class="text-center">
                                                        <div class="td-actions">
                                                            <a href="{{ route('admin.portfolio.edit', $portfolio) }}" class="icon green"
                                                                data-toggle="tooltip" title="Edit">
                                                                <i class="icon-edit"></i>
                                                            </a>
                                                            <form method="POST" action="{{ route('admin.portfolio.destroy', $portfolio) }}"
                                                                class="d-inline"
                                                                onsubmit="return confirm('Delete this portfolio item? This action cannot be undone.');">
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
                                                    <td colspan="5" class="text-center">No portfolio items found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($portfolios->hasPages())
                                    @include('admin.partials.pagination', ['data' => $portfolios])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
