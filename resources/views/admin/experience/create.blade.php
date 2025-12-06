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
                                <div class="card-title">Website Sections > Experience > Add</div>
                            </div>
                            <div class="card-body">
                                @include('admin.experience.form', [
                                    'submitLabel' => 'Create Experience',
                                    'formAction' => route('admin.experience.store'),
                                    'formMethod' => 'POST',
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
