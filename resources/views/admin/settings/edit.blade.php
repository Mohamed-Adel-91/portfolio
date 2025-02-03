@extends('admin.layouts.master')
@section('content')
    <div class="page-wrapper">

        <!-- Side bar area -->
        @include('admin.layouts.sidebar')
        <!-- Side bar area end -->

        <!-- ####################################################################### -->

        <!-- Page content area start -->

        <div class="page-content">

            <!-- Page Header Section start -->

            @include('admin.layouts.page-header')

            <!-- Page Header Section end -->


            <!-- Main container start -->
            <div class="main-container">
                @include('admin.layouts.alerts')
                <!-- Row start -->
                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row gutters">
                        <div class="col-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="card-title">General Data</div>
                                </div>
                                <div class="card-body">
                                    <div class="row gutters">


                                        <div class="form-group col-6">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                placeholder="Enter email ID" value="{{ $data->email }}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Enter Address" value="{{ $data->address }}">
                                            @if ($errors->has('address'))
                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="phone1">Phone 1</label>
                                            <input type="text" class="form-control" id="phone1" name="phone1"
                                                placeholder="Enter First phone number" value="{{ $data->phone1 }}">
                                            @if ($errors->has('phone1'))
                                                <span class="text-danger">{{ $errors->first('phone1') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="phone2">Phone 2</label>
                                            <input type="text" class="form-control" id="phone2" name="phone2"
                                                placeholder="Enter secondary phone number" value="{{ $data->phone2 }}">
                                            @if ($errors->has('phone2'))
                                                <span class="text-danger">{{ $errors->first('phone2') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="whats_up">WhatsApp</label>
                                            <input type="text" class="form-control" id="whats_up" name="whats_up"
                                                placeholder="Enter WhatsApp number" value="{{ $data->whats_up }}">
                                            @if ($errors->has('whats_up'))
                                                <span class="text-danger">{{ $errors->first('whats_up') }}</span>
                                            @endif
                                        </div>


                                        <div class="form-group col-6">
                                            <label for="facebook">Facebook</label>
                                            <input type="text" class="form-control" id="facebook" name="facebook"
                                                placeholder="Enter Facebook URL" value="{{ $data->facebook }}">
                                            @if ($errors->has('facebook'))
                                                <span class="text-danger">{{ $errors->first('facebook') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="messenger">Messenger</label>
                                            <input type="text" class="form-control" id="messenger" name="messenger"
                                                placeholder="Enter Messenger link" value="{{ $data->messenger }}">
                                            @if ($errors->has('messenger'))
                                                <span class="text-danger">{{ $errors->first('messenger') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="instagram">Instagram</label>
                                            <input type="text" class="form-control" id="instagram" name="instagram"
                                                placeholder="Enter Instagram URL" value="{{ $data->instagram }}">
                                            @if ($errors->has('instagram'))
                                                <span class="text-danger">{{ $errors->first('instagram') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="youtube">YouTube</label>
                                            <input type="text" class="form-control" id="youtube" name="youtube"
                                                placeholder="Enter YouTube URL" value="{{ $data->youtube }}">
                                            @if ($errors->has('youtube'))
                                                <span class="text-danger">{{ $errors->first('youtube') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="twitter">Twitter</label>
                                            <input type="text" class="form-control" id="twitter" name="twitter"
                                                placeholder="Enter Twitter URL" value="{{ $data->twitter }}">
                                            @if ($errors->has('twitter'))
                                                <span class="text-danger">{{ $errors->first('twitter') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="linkedin">LinkedIn</label>
                                            <input type="text" class="form-control" id="linkedin" name="linkedin"
                                                placeholder="Enter LinkedIn URL" value="{{ $data->linkedin }}">
                                            @if ($errors->has('linkedin'))
                                                <span class="text-danger">{{ $errors->first('linkedin') }}</span>
                                            @endif
                                        </div>


                                        <div class="form-group col-6">
                                            <label for="github">GitHub</label>
                                            <input type="text" class="form-control" id="github" name="github"
                                                placeholder="Enter GitHub URL" value="{{ $data->github }}">
                                            @if ($errors->has('github'))
                                                <span class="text-danger">{{ $errors->first('github') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="slogan">slogan</label>
                                            <input type="text" class="form-control" id="slogan" name="slogan"
                                                placeholder="Enter slogan" value="{{ $data->slogan }}">
                                            @if ($errors->has('slogan'))
                                                <span class="text-danger">{{ $errors->first('slogan') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="customers">Customer</label>
                                            <input type="number" class="form-control" name="customers"
                                                placeholder="Enter Customers Count" value="{{ $data->customers }}">
                                            @if ($errors->has('customers'))
                                                <span class="text-danger">{{ $errors->first('customers') }}</span>
                                            @endif
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

                    <div class="row gutters mt-2">
                        <div class="col-12">

                            <div class="row gutters mt-2">
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <div class="card-title">Meta Data</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row gutters">


                                                <div class="form-group col-6">
                                                    <label for="meta_title">Meta Title</label>
                                                    <input type="text" class="form-control" id="meta_title"
                                                        name="meta_title" placeholder="Enter Meta Title"
                                                        value="{{ $data->meta_title }}">
                                                    @if ($errors->has('meta_title'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('meta_title') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-6">
                                                    <label for="meta_tags">Meta Tags</label>
                                                    <input type="text" class="form-control" id="meta_tags"
                                                        name="meta_tags" placeholder="Enter Meta Tags"
                                                        value="{{ $data->meta_tags }}">
                                                    @if ($errors->has('meta_tags'))
                                                        <span class="text-danger">{{ $errors->first('meta_tags') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="meta_description">Meta Description</label>
                                                    <textarea class="form-control" id="meta_description" name="meta_description" rows="5"
                                                        placeholder="Enter Meta Description">{{ $data->meta_description }}</textarea>
                                                    @if ($errors->has('meta_description'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('meta_description') }}</span>
                                                    @endif
                                                </div>


                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="text-right">
                                                        <button type="submit" id="submit2"
                                                            class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>

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
