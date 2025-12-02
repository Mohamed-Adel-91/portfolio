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
                                <div class="card-title mb-0">Gallery</div>
                                <a class="btn btn-primary" href="{{ route('admin.gallery.create') }}">
                                    <i class="icon-plus-circle mr-1"></i>Add Item
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
                                                <th>Has Iframe?</th>
                                                <th>Created</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($galleries as $gallery)
                                                <tr>
                                                    <td>
                                                        @if ($gallery->image_path)
                                                            <img src="{{ asset($gallery->image_path) }}" alt="{{ $gallery->title }}"
                                                                style="width: 60px; height: 60px; object-fit: cover;">
                                                        @else
                                                            <span class="text-muted">No image</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $gallery->title }}</td>
                                                    <td>{{ $gallery->sub_title ?? 'N/A' }}</td>
                                                    <td>
                                                        @if (!empty($gallery->iframe))
                                                            <span class="badge bg-success">Yes</span>
                                                        @else
                                                            <span class="badge bg-secondary">No</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $gallery->created_at?->format('M d, Y') ?? 'N/A' }}</td>
                                                    <td class="text-center">
                                                        <div class="td-actions">
                                                            <a href="{{ route('admin.gallery.edit', $gallery) }}" class="icon green"
                                                                data-toggle="tooltip" title="Edit">
                                                                <i class="icon-edit"></i>
                                                            </a>
                                                            <form method="POST" action="{{ route('admin.gallery.destroy', $gallery) }}"
                                                                class="d-inline"
                                                                onsubmit="return confirm('Delete this gallery item? This action cannot be undone.');">
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
                                                    <td colspan="6" class="text-center">No gallery items found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($galleries->hasPages())
                                    @include('admin.partials.pagination', ['data' => $galleries])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
