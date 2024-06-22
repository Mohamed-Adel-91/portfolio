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


                                                <div class="form-group col-3">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email ID" value="{{ $data->email }}">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-3">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="{{ $data->phone }}">
                                                    @if ($errors->has('phone'))
                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="{{ $data->address }}">
                                                    @if ($errors->has('address'))
                                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-6">
                                                    <label for="facebook">Facebook</label>
                                                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Enter Facebook URL" value="{{ $data->facebook }}">
                                                    @if ($errors->has('facebook'))
                                                        <span class="text-danger">{{ $errors->first('facebook') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-6">
                                                    <label for="twitter">Twitter</label>
                                                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Enter Twitter URL" value="{{ $data->twitter }}">
                                                    @if ($errors->has('twitter'))
                                                        <span class="text-danger">{{ $errors->first('twitter') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="instagram">Instagram</label>
                                                    <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Enter Instagram URL" value="{{ $data->instagram }}">
                                                    @if ($errors->has('instagram'))
                                                        <span class="text-danger">{{ $errors->first('instagram') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="linkedin">LinkedIn</label>
                                                    <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Enter LinkedIn URL" value="{{ $data->linkedin }}">
                                                    @if ($errors->has('linkedin'))
                                                        <span class="text-danger">{{ $errors->first('linkedin') }}</span>
                                                    @endif
                                                </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="text-right">
                                                    <button type="submit" id="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters mt-2">
                            <div class="col-6">

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
                                                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" value="{{ $data->meta_title }}">
                                                        @if ($errors->has('meta_title'))
                                                            <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <label for="meta_tags">Meta Tags</label>
                                                        <input type="text" class="form-control" id="meta_tags" name="meta_tags" placeholder="Enter Meta Tags" value="{{ $data->meta_tags }}">
                                                        @if ($errors->has('meta_tags'))
                                                            <span class="text-danger">{{ $errors->first('meta_tags') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="meta_description">Meta Description</label>
                                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="5"
                                                                placeholder="Enter Meta Description">{{ $data->meta_description }}</textarea>
                                                        @if ($errors->has('meta_description'))
                                                            <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                                                        @endif
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="text-right">
                                                            <button type="submit" id="submit2" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">


                        <div class="row gutters mt-2">
                            <div class="col-12">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <div class="card-title">Counters Data</div>
                                    </div>
                                    <div class="card-body py-4">
                                        <div class="row gutters">
                                            <div class="form-group col-6">
                                                <label for="cards">Cards</label>
                                                <input type="number" class="form-control" id="cards" name="cards" placeholder="Enter Cards" value="{{ $data->cards }}">
                                                @if ($errors->has('cards'))
                                                    <span class="text-danger">{{ $errors->first('cards') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="transactions">Transactions</label>
                                                <input type="number" class="form-control" id="transactions" name="transactions" placeholder="Enter Transactions" value="{{ $data->transactions }}">
                                                @if ($errors->has('transactions'))
                                                    <span class="text-danger">{{ $errors->first('transactions') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="countries">Countries</label>
                                                <input type="number" class="form-control" id="countries" name="countries" placeholder="Enter Countries" value="{{ $data->countries }}">
                                                @if ($errors->has('countries'))
                                                    <span class="text-danger">{{ $errors->first('countries') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="decades">Decades</label>
                                                <input type="number" class="form-control" id="decades" name="decades" placeholder="Enter Decades" value="{{ $data->decades }}">
                                                @if ($errors->has('decades'))
                                                    <span class="text-danger">{{ $errors->first('decades') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="customers">Customer</label>
                                                <input type="number" class="form-control" name="customers" placeholder="Enter Customers" value="{{ $data->customers }}">
                                                @if ($errors->has('decades'))
                                                    <span class="text-danger">{{ $errors->first('decades') }}</span>
                                                @endif
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="text-right">
                                                    <button type="submit" id="submit3" class="btn btn-primary">Save</button>
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
