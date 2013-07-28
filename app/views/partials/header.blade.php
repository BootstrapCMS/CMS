<head>

    <meta charset="utf-8">
    <title>
        {{ Config::get('cms.name') }} - @section('title')
        @show
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ Config::get('cms.name') }}">
    <meta name="author" content="Graham Campbell">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-responsive.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/switch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prettify.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!--[if IE]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="//ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

</head>
