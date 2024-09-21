@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <!-- Side bar area -->
        @include('admin.layouts.sidebar')
        <!-- Side bar area end -->

        <!-- Page content area start -->
        <div class="page-content">
            <!-- Page Header Section start -->
            @include('admin.layouts.page-header')
            <!-- Page Header Section end -->

            <!-- Main container start -->
            <div class="main-container">
                @include('admin.layouts.alerts')
                <!-- Row start -->
                <form method="POST"
                    action="{{ isset($data) ? route('admin.sliders.update', $data->id) : route('admin.sliders.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if (isset($data))
                        @method('PUT')
                    @endif
                    <div class="row gutters">
                        <div class="col-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="card-title">{{ isset($data) ? 'Edit' : 'Create' }} Sliders Data</div>
                                </div>
                                <div class="card-body">
                                    <div class="row gutters">
                                        @php
                                            $languages = ['en' => 'English', 'ar' => 'Arabic', 'fr' => 'French'];
                                            $pageOptions = [
                                                'Home' => 'Home',
                                                'about-us' => 'about-us',
                                                'our-Fleet' => 'our-Fleet',
                                                'Contact-Us' => 'Contact-Us',
                                                'Whats-New' => 'Whats-New',
                                                'Careers' => 'Careers',
                                                'Services' => 'Services',
                                                'FAQs' => 'FAQs',
                                                'Help-Center' => 'Help-Center',
                                                'Terms' => 'Terms',
                                            ];
                                            $sectionOptions = [
                                                'Home-first-banner' => 'Home-first-banner',
                                                'homeOurHistory' => 'homeOurHistory',
                                                'homeOurFleet' => 'homeOurFleet',
                                                'homeServices' => 'homeServices',
                                                'homeHelpCenter' => 'homeHelpCenter',
                                                'about-us-first-banner' => 'about-us-first-banner',
                                                'about-us-ourHistory' => 'about-us-ourHistory',
                                                'about-us-ourServices' => 'about-us-ourServices',
                                                'about-us-ourDna' => 'about-us-ourDna',
                                                'about-us-teams' => 'about-us-teams',
                                                'about-us-joinUs' => 'about-us-joinUs',
                                                'our-Fleet-first-banner' => 'our-Fleet-first-banner',
                                                'our-Fleet-second-section' => 'our-Fleet-second-section',
                                                'our-Fleet-ourServices' => 'our-Fleet-ourServices',
                                                'our-Fleet-Transparency' => 'our-Fleet-Transparency',
                                                'Contact-Us-start-banner' => 'Contact-Us-start-banner',
                                                'Contact-Us-Help-Center' => 'Contact-Us-Help-Center',
                                                'Contact-Us-Last-Section' => 'Contact-Us-Last-Section',
                                                'Contact-Us-Help-Center' => 'Contact-Us-Help-Center',
                                                'Whats-New-Start-Section' => 'Whats-New-Start-Section',
                                                'Whats-New-Second-Section' => 'Whats-New-Second-Section',
                                                'Careers-Start-Banner' => 'Careers-Start-Banner',
                                                'Careers-second-section' => 'Careers-second-section',
                                                'Careers-last-section' => 'Careers-last-section',
                                                'Services-start-section' => 'Services-start-section',
                                                'Services-card-section' => 'Services-card-section',
                                                'FAQs-start-section' => 'FAQs-start-section',
                                                'Help-Center-start-section' => 'Help-Center-start-section',
                                                'Help-Center-card-section' => 'Help-Center-card-section',
                                                'Terms-start-section' => 'Terms-start-section',
                                                'Terms-card-section' => 'Terms-card-section',
                                                'Terms-contact-section' => 'Terms-contact-section',
                                            ];
                                        @endphp

                                        <div class="form-group col-6">
                                            <label for="pageName">Page Name</label>
                                            @if ($isUpdate)
                                                <input type="text" class="form-control" id="pageName" name="pageName"
                                                    value="{{ isset($data) ? $data->pageName : old('pageName') }}" disabled>
                                                <input type="hidden" name="pageName" value="{{ $data->pageName }}">
                                            @else
                                                <select class="form-control" id="pageName" name="pageName">
                                                    <option value="" disabled selected>Select page name...</option>
                                                    @foreach ($pageOptions as $value => $label)
                                                        <option value="{{ $value }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @if ($errors->has('pageName'))
                                                <span class="text-danger">{{ $errors->first('pageName') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="sectionName">Section Name</label>
                                            @if ($isUpdate)
                                                <input type="text" class="form-control" id="sectionName"
                                                    name="sectionName"
                                                    value="{{ isset($data) ? $data->sectionName : old('sectionName') }}"
                                                    disabled>
                                                <input type="hidden" name="sectionName" value="{{ $data->sectionName }}">
                                            @else
                                                <select class="form-control" id="sectionName" name="sectionName">
                                                    <option value="" disabled selected>Select section name...</option>
                                                    @foreach ($sectionOptions as $value => $label)
                                                        <option value="{{ $value }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @if ($errors->has('sectionName'))
                                                <span class="text-danger">{{ $errors->first('sectionName') }}</span>
                                            @endif
                                        </div>

                                        @foreach ($languages as $lang => $language)
                                            <div class="form-group col-4">
                                                <label for="title_{{ $lang }}">Title ({{ $language }})</label>
                                                <input type="text" class="form-control" id="title_{{ $lang }}"
                                                    name="title[{{ $lang }}]"
                                                    placeholder="Enter title in {{ $language }}"
                                                    value="{{ isset($data) ? $data->getTranslation('title', $lang) : old('title.' . $lang) }}">
                                                @if ($errors->has('title.' . $lang))
                                                    <span class="text-danger">{{ $errors->first('title.' . $lang) }}</span>
                                                @endif
                                            </div>
                                        @endforeach

                                        @foreach ($languages as $lang => $language)
                                            <div class="form-group col-4">
                                                <label for="description_{{ $lang }}">Description
                                                    ({{ $language }})
                                                </label>
                                                <textarea class="form-control" id="description_{{ $lang }}" name="description[{{ $lang }}]"
                                                    placeholder="Enter description in {{ $language }}">{{ isset($data) ? $data->getTranslation('description', $lang) : old('description.' . $lang) }}</textarea>
                                                @if ($errors->has('description.' . $lang))
                                                    <span
                                                        class="text-danger">{{ $errors->first('description.' . $lang) }}</span>
                                                @endif
                                            </div>
                                        @endforeach

                                        <div class="form-group col-6">
                                            <label for="show_status">Show Status</label>
                                            <select class="form-control" id="show_status" name="show_status">
                                                <option value="" disabled
                                                    {{ old('show_status', isset($data) ? $data->show_status : null) === null ? 'selected' : '' }}>
                                                    Select show status...
                                                </option>
                                                <option value="Active"
                                                    {{ old('show_status', isset($data) ? $data->show_status : null) === 'Active' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="Inactive"
                                                    {{ old('show_status', isset($data) ? $data->show_status : null) === 'Inactive' ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                            @if ($errors->has('show_status'))
                                                <span class="text-danger">{{ $errors->first('show_status') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="slider_no">Slider No.</label>
                                            <input type="number" class="form-control" id="slider_no" name="slider_no"
                                                placeholder="Enter slider number"
                                                value="{{ isset($data) ? $data->slider_no : old('slider_no') }}">
                                            @if ($errors->has('slider_no'))
                                                <span class="text-danger">{{ $errors->first('slider_no') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="btn_url">Button Url</label>
                                            <input type="url" class="form-control" id="btn_url" name="btn_url"
                                                placeholder="Enter btn_url"
                                                value="{{ isset($data) ? $data->btn_url : old('btn_url') }}">
                                            @if ($errors->has('btn_url'))
                                                <span class="text-danger">{{ $errors->first('btn_url') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-3">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control-file" id="image" name="image">
                                            @if ($errors->has('image'))
                                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-3">
                                            <label for="image_preview">Image Preview</label>
                                            <div id="image_preview">
                                                @if (isset($data) && $data->image)
                                                    <img src="{{ $data->image_path }}" alt="Image Preview"
                                                        class="img-thumbnail" style="max-height: 200px; width: auto;">
                                                @else
                                                    <p id="not_found_span">No image selected</p>
                                                    <img src="" class="img-thumbnail"
                                                        style="max-height: 200px; width: auto;">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="text-right">
                                                <button type="submit" id="submit"
                                                    class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Row end -->

            </div>
            <!-- Main container end -->

        </div>
        <!-- Page content area end -->

    </div>
@endsection

@push('custom-js-scripts')
    <script>
        $(document).ready(function() {
            $('#image').on('change', function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_preview img').attr('src', e.target.result);
                    };
                    if ($('#not_found_span').length) {
                        $('#not_found_span').fadeOut();
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#image_preview img').attr('src', '');
                    $('#not_found_span').fadeIn();
                }
            });
        });
    </script>
@endpush
