<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <link rel="icon" href="{{ asset('assets/img/2.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/2.png') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/2.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/2.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/2.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/2.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/2.png') }}" />
    <link rel="canonical" href="https://www.mohamed-nouh.com/" />
    <meta name="author" content="Mohamed Adel Nouh" />
    <meta name="theme-color" content="#000000" />
    <meta name="msapplication-TileColor" content="#000000" />
    <title>{{ optional($setting)->meta_title ?? config('app.name') }}</title>
    <meta name="keywords" content="{{ optional($setting)->meta_tags ?? '' }}">
    <meta name="description" content="{{ optional($setting)->meta_description ?? '' }}">
    <meta property="og:title" content="{{ optional($setting)->meta_title ?? config('app.name') }}" />
    <meta property="og:description" content="{{ optional($setting)->meta_description ?? '' }}" />
    <meta property="og:image" content="{{ $intro ? asset($intro->image_path) : asset('1.jpg') }}" />
    <meta property="twitter:image" content="{{ $intro ? asset($intro->image_path) : asset('1.jpg') }}" />
    <!-- ========================= CSS ============================ -->
    @include('web.layouts.scripts.css')

</head>

<body>

    <!-- loader -->
    @include('web.layouts.loader')
    <!-- loader -->

    <!-- header -->
    @include('web.layouts.header')
    <!-- end header -->

    <!-- about -->
    @include('web.about')
    <!-- end about -->

    <!-- resume -->
    @include('web.resume')
    <!-- end resume -->

    <!-- portfolio -->
    @include('web.portfolio')
    <!-- end portfolio -->

    <!-- projects -->
    @include('web.projects')
    <!-- end projects -->

    <!-- contact -->
    @include('web.contact')
    <!-- end contact -->

    <!-- payment -->
    {{-- @include('web.payment') --}}
    <!-- end payment -->

    <!-- footer -->
    {{-- @include('web.layouts.footer') --}}
    <!-- end footer -->

    <!-- JS -->
    @include('web.layouts.scripts.js')

</body>

</html>
