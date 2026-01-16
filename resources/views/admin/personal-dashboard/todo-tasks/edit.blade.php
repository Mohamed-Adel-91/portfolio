@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        @include('admin.layouts.sidebar')

        <div class="page-content">
            @include('admin.layouts.page-header')

            <div class="main-container">
                @include('admin.layouts.alerts')

                <form method="POST" action="{{ route('admin.personal.todo-tasks.update', $task) }}">
                    @csrf
                    @method('PUT')
                    <div class="row gutters">
                        <div class="col-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="card-title">Personal Dashboard > Tasks > Edit</div>
                                </div>
                                <div class="card-body">
                                    @include('admin.personal-dashboard.todo-tasks._form', ['submitLabel' => 'Update Task'])
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row gutters mt-3">
                    <div class="col-12">
                        @include('admin.personal-dashboard.todo-tasks._items')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
