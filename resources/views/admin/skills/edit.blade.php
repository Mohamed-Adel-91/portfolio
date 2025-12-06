@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        @include('admin.layouts.sidebar')

        <div class="page-content">
            @include('admin.layouts.page-header')

            <div class="main-container">
                @include('admin.layouts.alerts')

                <form method="POST" action="{{ route('admin.skills.update', $skill) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row gutters">
                        <div class="col-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="card-title">Website Sections > Skills > Edit</div>
                                </div>
                                <div class="card-body">
                                    @include('admin.skills.form', ['submitLabel' => 'Update Skill'])
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
