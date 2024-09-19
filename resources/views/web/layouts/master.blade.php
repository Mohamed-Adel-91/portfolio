<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="images/favicon.png">
    <title>Mohamed Adel - Personal Portfolio Website</title>

    @include('home.css')
    <!-- ========================= CSS ============================ -->

</head>

<body>

    <!-- loader -->
    @include('home.loader')
    <!-- loader -->

    <!-- header -->
    @include('home.header')
    <!-- end header -->

    <!-- about -->
    @include('home.about')
    <!-- end about -->

    <!-- resume -->
    @include('home.resume')
    <!-- end resume -->

    <!-- portfolio -->
    {{-- @include('home.portfolio') --}}
    <!-- end portfolio -->

    <!-- projects -->
    @include('home.projects')
    <!-- end projects -->

    <!-- contact -->
    @include('home.contact')
    <!-- end contact -->

    <!-- payment -->
    @include('home.payment')
    <!-- end payment -->

    <!-- footer -->
    @include('home.footer')
    <!-- end footer -->

    <!-- JS -->
    @include('home.scripts')

</body>

</html>
