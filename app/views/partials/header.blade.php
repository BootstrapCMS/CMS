<head>

    <meta charset="utf-8">
    <title>
        {{ Config::get('cms.name') }} - @section('title')
        @show
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ Config::get('cms.name') }}">
    <meta name="author" content="Graham Campbell">

    {{ Basset::show('main.css') }}
    @section('css')
    @show
    {{ Basset::show('extra.css') }}

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

</head>
