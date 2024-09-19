<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/1.ico') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('admin.layouts.scripts.css')
    @stack('custom-css-scripts')
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Pleaseupgrade your browser to improve your experience.</p>
        <![endif]-->

    <!-- Loading starts -->
    <div id="loading-wrapper">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Loading ends -->

    <!-- page container area start -->

    <div class="main-content">
        @yield('content')
    </div>

    <!-- offset area end -->

    <!-- page footer start -->

    @include('admin.layouts.footer')
    @stack('custom-js-scripts')

    <!-- footer area end -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
