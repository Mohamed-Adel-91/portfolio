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
                            <div class="card-header">
                                <div class="card-title">Website Sections > Experience > Edit</div>
                            </div>
                            <div class="card-body">
                                @include('admin.experience.form', [
                                    'submitLabel' => 'Update Experience',
                                    'formAction' => route('admin.experience.update', $experience),
                                    'formMethod' => 'PUT',
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
