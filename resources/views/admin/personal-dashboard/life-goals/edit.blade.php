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
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-title mb-0">Edit Goal Item</div>
                                <a href="{{ route('admin.personal.life-goals.index') }}"
                                    class="btn btn-outline-secondary">Back</a>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.personal.life-goal-items.update', $item) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @include('admin.personal-dashboard.life-goals._form', ['submitLabel' => 'Update'])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('custom-css-scripts')
    <style>
        .goal-image-preview {
            border: 1px dashed #ced4da;
            border-radius: 8px;
            padding: 8px;
            text-align: center;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }

        .goal-image-preview img {
            max-width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
@endpush

@push('custom-js-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('image');
            const preview = document.getElementById('goalImagePreview');

            if (!input || !preview) {
                return;
            }

            input.addEventListener('change', function() {
                const file = input.files && input.files[0] ? input.files[0] : null;
                if (!file) {
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.innerHTML = `<img src="${event.target.result}" alt="Goal image preview">`;
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
