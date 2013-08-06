<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ Config::get('cms.name') }}">
<meta name="author" content="Graham Campbell">
{{ Basset::show('main.css') }}
@section('css')
@show
{{ Basset::show('extra.css') }}

<!--[if IE]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="//ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
