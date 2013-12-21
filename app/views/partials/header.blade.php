<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{{ Config::get('platform.description') }}}">
<meta name="author" content="{{{ Config::get('platform.author') }}}">

{{ Asset::styles('main') }}
@section('css')
@show

<!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
