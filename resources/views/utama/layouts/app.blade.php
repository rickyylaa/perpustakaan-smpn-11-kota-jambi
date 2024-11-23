
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo.png') }}" type="image/x-icon">

    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/flaticon-set.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/elegant-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/bootsnav.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/responsive.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="se-pre-con"></div>

    @include('utama.layouts.header')

    @yield('content')

    <script src="{{ asset('dist/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/equal-height.min.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('dist/js/modernizr.custom.13711.js') }}"></script>
    <script src="{{ asset('dist/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('dist/js/wow.min.js') }}"></script>
    <script src="{{ asset('dist/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('dist/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('dist/js/count-to.js') }}"></script>
    <script src="{{ asset('dist/js/loopcounter.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootsnav.js') }}"></script>
    <script src="{{ asset('dist/js/main.js') }}"></script>
</body>
</html>
