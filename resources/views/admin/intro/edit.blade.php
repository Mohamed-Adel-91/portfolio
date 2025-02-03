@extends('admin.layouts.master')
@section('content')

<div class="page-wrapper">
    @include('admin.layouts.sidebar')

    <div class="page-content">
        @include('admin.layouts.page-header')

        <div class="main-container">
            @include('admin.layouts.alerts')

            <form method="POST" action="{{ route('admin.intro.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row gutters">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-title">Intro Section</div>
                            </div>
                            <div class="card-body">
                                <div class="row gutters">
                                    <div class="form-group col-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}">
                                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="image">Intro Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @if($data->image)
                                        <img src="{{ $data->image_path }}" alt="Intro Image" width="300">
                                        @endif
                                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="cv_pdf">Upload CV</label>
                                        <input type="file" class="form-control" id="cv_pdf" name="cv_pdf">
                                        @if($data->cv_pdf)
                                            <a href="{{ $data->cv_pdf_path }}" target="_blank">View CV</a>
                                        @endif
                                        @error('cv_pdf') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
