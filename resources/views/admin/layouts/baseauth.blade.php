{{-- Layout base used for authentication --}}
    <!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="{{ asset('packages/foostart/css/bootstrap-3.3.7.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/foostart/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/foostart/css/font-awesome-4.7.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/foostart/css/fonts.css') }}">

@yield('head_css')
{{-- End head css --}}

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('packages/foostart/js/vendor/html5shiv.js') }}"></script>
    <script src="{{ asset('packages/foostart/js/vendor/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body>
{{-- content --}}
<div class="container">
    @yield('container')
</div>

{{-- Start footer scripts --}}
<script src="{{ asset('packages/foostart/js/vendor/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('packages/foostart/js/vendor/bootstrap.min.js') }}"></script>
</body>
</html>
