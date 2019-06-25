<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Phone Shop') }}</title> --}}
    <title>{{ 'Phone Shop' }}</title>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('bootshop/bootstrap.min.css') }}" rel="stylesheet" media="screen">


    <!-- Custom Styles -->
    {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/site-custom.css') }}" rel="stylesheet">

    <!-- Bootstrap style responsive -->	
    <link href="{{ asset('css/bootstrap-responsive.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <!-- Google-code-prettify -->	
    <link href="{{ asset('google-code-prettify/prettify.css') }}" rel="stylesheet"/>

    <!-- Glyphicons -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->   


</head>
<body class="{{ Request::is('/') ? 'backf-bg' : '' }}">
    <div id="app">        
        <!-- Navigation -->
        @include('inc.header')
        <!-- Show only on Home page -->
        {{-- @if(Request::is('/') || Request::is('products') || Request::is('products/category*'))
            @include('inc.home-banner')
        @endif --}}
        <!-- /.Show only on Home page -->
        <div id="mainBody">
            <div class="container {{ Request::is('/') || Request::is('products') || Request::is('products/category*') ? 'bigc' : '' }}">
                <div class="row"> 
                    @yield('content')
                </div>
            </div>
        </div>
        @include('inc.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('google-code-prettify/prettify.js') }}"></script>
    <script src="{{ asset('js/bootshop.js') }}"></script>
    <script src="{{ asset('js/jquery.lightbox-0.5.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

</body>
</html>
