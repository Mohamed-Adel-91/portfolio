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
                                <div class="card-title mb-0">Add Goal Category</div>
                                <a href="{{ route('admin.personal.life-goal-categories.index') }}"
                                    class="btn btn-outline-secondary">Back</a>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.personal.life-goal-categories.store') }}">
                                    @csrf
                                    @include('admin.personal-dashboard.life-goal-categories._form', ['submitLabel' => 'Create'])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
