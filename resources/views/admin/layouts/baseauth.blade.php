{{-- Layout base used for authentication --}}
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">


    {!! HTML::style('packages/foostart/css/bootstrap-3.3.7.min.css') !!}
    {!! HTML::style('packages/foostart/css/style.css') !!}
    {!! HTML::style('packages/foostart/css/font-awesome-4.7.0.min.css') !!}
    {!! HTML::style('packages/foostart/css/fonts.css') !!}

    @yield('head_css')
    {{-- End head css --}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

    <body>
        {{-- content --}}
        <div class="container">
            @yield('container')
        </div>

        {{-- Start footer scripts --}}
        {!! HTML::script('packages/foostart/js/vendor/jquery-1.10.2.min.js') !!}
        {!! HTML::script('packages/foostart/js/vendor/bootstrap.min.js') !!}
    </body>
</html>