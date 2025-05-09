{{-- Layout base admin panel --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="{{ asset('packages/foostart/css/bootstrap-3.3.7.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/foostart/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/foostart/css/baselayout.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/foostart/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/foostart/css/font-awesome-4.7.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/foostart/css/package-category.css') }}">

    <script src="{{ asset('packages/foostart/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('packages/foostart/js/vendor/bootstrap-3.3.7.min.js') }}"></script>



    @yield('head_css')
{{-- End head css --}}

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('packages/foostart/js/vendor/lt-IE-9/html5shiv-3.7.0.js') }}"></script>
    <script src="{{ asset('packages/foostart/js/vendor/lt-IE-9/respond-1.3.0.min.js') }}"></script>
    <![endif]-->
</head>

<body>
{{-- navbar --}}
@include('package-acl::admin.layouts.navbar')

{{-- content --}}
<div class="container-fluid">
    @yield('container')
</div>

{{-- Start footer scripts --}}
@yield('before_footer_scripts')

@yield('footer_scripts')
{{-- End footer scripts --}}
</body>
</html>
