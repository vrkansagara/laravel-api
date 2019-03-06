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
    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>

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

    <!-- Toastr style -->
    <link href="{{asset('assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Custom Style -->
    <link href="{{asset('assets/css/custom/custom.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom/custom.css')}}" rel="stylesheet">

    @yield('after-style')

    @include('layouts.partials.google.analytics')

</head>
<body class="@yield('body-class')">
<div id="wrapper @yield('wrapper')">

    @include('layouts.partials.left-navigation')

    <div id="page-wrapper" class="gray-bg @yield('page-wrapper-class')">
        @include('layouts.partials.top-navigation')
{{--        @include('layouts.partials.bradcrumb')--}}
        <div class="wrapper wrapper-content @yield('wrapper-class')">
            @yield('content')
        </div>
        @include('layouts.partials.footer')
    </div>
</div>

@yield('before-script')
<!-- Mainly scripts -->
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{asset('assets/js/inspinia.js')}}"></script>
<script src="{{asset('assets/js/plugins/pace/pace.min.js')}}"></script>


<!-- Toastr script -->
<script src="{{asset('assets/js/plugins/toastr/toastr.min.js')}}"></script>


<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('assets/js/custom/custom.js')}}"></script>
<script src="{{asset('assets/js/custom/ajax.js')}}"></script>
<script src="{{asset('assets/js/custom/datatable.js')}}"></script>
@yield('after-script')

@include('layouts.partials.toast')
</body>
</html>
