<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @yield('before-meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('after-meta')
    <title>{{ config('app.name', 'Laravel Enterprise Starter Kit') }}</title>

    <!-- Scripts -->
    <script src="{{asset('assets/js/jquery-3.1.1.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

    </script>

    @yield('before-style')
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <!-- Custom Style -->
    <link href="{{asset('assets/css/custom/custom.css')}}" rel="stylesheet">
    @yield('after-style')

</head>

<body class="gray-bg @yield('body-class')">
@yield('content')
@yield('before-script')
@yield('after-script')
</body>
</html>
