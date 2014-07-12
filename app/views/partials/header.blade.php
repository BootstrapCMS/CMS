<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{{ Config::get('platform.description') }}}">
<meta name="author" content="{{{ Config::get('platform.author') }}}">

{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css') }}
{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/animate.css/3.1.0/animate.min.css') }}
{{ Asset::styles('main') }}
@section('css')
@show

<!--[if lt IE 9]>
  {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js') }}
  {{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js') }}
<![endif]-->

<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
