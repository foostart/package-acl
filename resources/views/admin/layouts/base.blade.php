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


    {!! HTML::style('packages/foostart/css/bootstrap-3.3.7.min.css') !!}
    {!! HTML::style('packages/foostart/css/style.css') !!}
    {!! HTML::style('packages/foostart/css/baselayout.css') !!}
    {!! HTML::style('packages/foostart/css/fonts.css') !!}
    {!! HTML::style('packages/foostart/css/font-awesome-4.7.0.min.css') !!}
    {!! HTML::style('packages/foostart/css/package-category.css') !!}

    @yield('head_css')
    {{-- End head css --}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        {!! HTML::script('packages/foostart/js/vendor/lt-IE-9/html5shiv-3.7.0') !!}
        {!! HTML::script('packages/foostart/js/vendor/lt-IE-9/respond-1.3.0.min') !!}
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

        {!! HTML::script('packages/foostart/js/vendor/jquery-2.2.4.min.js') !!}
        {!! HTML::script('packages/foostart/js/vendor/bootstrap-3.3.7.min.js') !!}

        @yield('footer_scripts')
        {{-- End footer scripts --}}
    </body>
</html>