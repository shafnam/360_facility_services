<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('theme/css/sb-admin.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('theme/css/plugins/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('theme/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Glyphicons -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    @if(Auth::check() && Auth::user()->title == "Administrator")
    <div id="wrapper">    
        @include('admin.header')
    @endif
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    {{-- <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script> --}}

    <!-- Custom Script-->
    <script src="{{ asset('theme/js/custom.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    {{-- <script src="{{ asset('theme/js/plugins/morris/raphael.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/morris/morris-data.js') }}"></script> --}}
</body>
</html>
