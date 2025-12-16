<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <title>{{ optional($setting)->meta_title ?? config('app.name') }}</title>
    <meta name="description" content="{{ optional($setting)->meta_description ?? '' }}">
    <meta name="keywords" content="{{ optional($setting)->meta_tags ?? '' }}">

    @include('web.layouts.scripts.css')
    <!-- ========================= CSS ============================ -->

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
