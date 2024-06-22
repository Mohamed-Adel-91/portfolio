@extends('admin.layouts.master')
@section('content')
    <div class="page-wrapper">

        <!-- Page content area start -->
        <div class="container">

            <form action="{{ url('/login') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-md-center">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                        <div class="login-screen">
                            <div class="login-box" style="background-color: black;  border-radius: 10px;">
                                <div class="login-box-header"
                                    style="display: block; width: 100%; text-align: center; padding: 1px;
                                    margin-bottom: 15px;">
                                    <a href="#" class="login-logo"
                                        style="display: block; width: 100%; text-align: center;">
                                        <img src="{{ asset('assets/img/logo.png') }}" alt="Admin Dashboard" />
                                    </a>
                                </div>
                                <h5>Welcome back,<br />Please Login to your Account.</h5>
                                @include('admin.layouts.alerts')
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" />
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" />
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="actions mb-4">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
