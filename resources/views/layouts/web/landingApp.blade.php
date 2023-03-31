<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradise</title>

    <!-- Bootstrap 3.3.7  -->
    <link rel="stylesheet" href="{{ asset('web_files/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_files/assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_files/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('web_files/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('web_files/assets/css/hover.css') }}">
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('web_files/assets/css/font-awesome-rtl.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('web_files/assets/css/bootstrap-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web_files/assets/css/rtl.css') }}">
        <style>
            body,
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            span {
                font-family: 'Cairo', sans-serif !important;
            }

        </style>
    @else
        <!-- of english -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/brands.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/regular.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/solid.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/svg-with-js.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web_files/assets/css/fontawesome/v4-shims.min.css') }}">
    @endif

    <script src="{{ asset('web_files/assets/js/jquery.min.js') }}"></script>

    <!-- html in  internet explorer  -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Paytone+One&display=swap');

        @import url('https://fonts.googleapis.com/css2?family=Allison&family=Lobster&family=Pacifico&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap');

    </style>
</head>

<body>
    <div id="loading" class="loader loader--style6" title="5">
        <img src="{{ asset('web_files/assets/img/preload.svg') }}" id="loading-image" alt="">
    </div>
    @yield('content')

    <button class="to-top-button">
        <i class="fas fa-arrow-up" style="font-size: 20px;"></i>
    </button>
    @include('layouts.web.footer')
</body>

<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('web_files/assets/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('web_files/assets/js/all.js') }}"></script>
<!-- print this -->
<script src="{{ asset('web_files/assets/js/printThis.js') }}"></script>


<script>
    $(document).ready(function() {
        $(window).scroll(function(event) {
            if ($(this).scrollTop() > 0) {
                $('.to-top-button').show();
            } else {
                $('.to-top-button').hide();
            }
        });
        $('.to-top-button').click(function() {
            document.documentElement.scrollTop = 0;

        });
    });

    $(window).on('load', function() {
        $('#loading').hide();
    })
</script>

</html>
