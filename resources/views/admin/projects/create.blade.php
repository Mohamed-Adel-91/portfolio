@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        @include('admin.layouts.sidebar')

        <div class="page-content">
            @include('admin.layouts.page-header')

            <div class="main-container">
                @include('admin.layouts.alerts')

                <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row gutters">
                        <div class="col-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="card-title">Website Sections > Projects > Add</div>
                                </div>
                                <div class="card-body">
                                    @include('admin.projects.form', ['submitLabel' => 'Create Project'])
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
