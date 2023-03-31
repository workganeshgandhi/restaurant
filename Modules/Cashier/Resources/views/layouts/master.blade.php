<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('cashier_files/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('cashier_files/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('cashier_files/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('cashier_files/css/asset.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/regular.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/solid.min.css') }}">

    <title>Cashier</title>
</head>

<body style="height: auto !important">

    @include('cashier::layouts.nav')

    @yield('content')

    @yield('vue')
    <script src="{{ asset('cashier_files/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('cashier_files/js/popper.min.js') }}"></script>
    <script src="{{ asset('cashier_files/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('cashier_files/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('cashier_files/js/main.js') }}"></script>

</body>

</html>
