<!doctype html>
<html lang="en-GB">
<head>

    <meta charset="utf-8">
    <title>
        {{ Config::get('cms.name') }} - Error {{ $code }}
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ Config::get('cms.name') }}">
    <meta name="author" content="Graham Campbell">

    <style type="text/css">
        @import url(http://fonts.googleapis.com/css?family=Droid+Sans);

        article, aside, details, figcaption, figure, footer, header, hgroup, nav, section { display: block; }
        audio, canvas, video { display: inline-block; *display: inline; *zoom: 1; }
        audio:not([controls]) { display: none; }
        [hidden] { display: none; }
        html { font-size: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        html, button, input, select, textarea { font-family: sans-serif; color: #222; }
        body { margin: 0; font-size: 1em; line-height: 1.4; }
        ::-moz-selection { background: #E37B52; color: #fff; text-shadow: none; }
        ::selection { background: #E37B52; color: #fff; text-shadow: none; }
        a { color: #00e; }
        a:visited { color: #551a8b; }
        a:hover { color: #06e; }
        a:focus { outline: thin dotted; }
        a:hover, a:active { outline: 0; }
        abbr[title] { border-bottom: 1px dotted; }
        b, strong { font-weight: bold; }
        blockquote { margin: 1em 40px; }
        dfn { font-style: italic; }
        hr { display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0; }
        ins { background: #ff9; color: #000; text-decoration: none; }
        mark { background: #ff0; color: #000; font-style: italic; font-weight: bold; }
        pre, code, kbd, samp { font-family: monospace, serif; _font-family: 'courier new', monospace; font-size: 1em; }
        pre { white-space: pre; white-space: pre-wrap; word-wrap: break-word; }
        q { quotes: none; }
        q:before, q:after { content: ""; content: none; }
        small { font-size: 85%; }
        sub, sup { font-size: 75%; line-height: 0; position: relative; vertical-align: baseline; }
        sup { top: -0.5em; }
        sub { bottom: -0.25em; }
        ul, ol { margin: 1em 0; padding: 0 0 0 40px; }
        dd { margin: 0 0 0 40px; }
        nav ul, nav ol { list-style: none; list-style-image: none; margin: 0; padding: 0; }
        img { border: 0; -ms-interpolation-mode: bicubic; vertical-align: middle; }
        svg:not(:root) { overflow: hidden; }
        figure { margin: 0; }
        form { margin: 0; }
        fieldset { border: 0; margin: 0; padding: 0; }
        label { cursor: pointer; }
        legend { border: 0; *margin-left: -7px; padding: 0; white-space: normal; }
        button, input, select, textarea { font-size: 100%; margin: 0; vertical-align: baseline; *vertical-align: middle; }
        button, input { line-height: normal; }
        button, input[type="button"], input[type="reset"], input[type="submit"] { cursor: pointer; -webkit-appearance: button; *overflow: visible; }
        button[disabled], input[disabled] { cursor: default; }
        input[type="checkbox"], input[type="radio"] { box-sizing: border-box; padding: 0; *width: 13px; *height: 13px; }
        input[type="search"] { -webkit-appearance: textfield; -moz-box-sizing: content-box; -webkit-box-sizing: content-box; box-sizing: content-box; }
        input[type="search"]::-webkit-search-decoration, input[type="search"]::-webkit-search-cancel-button { -webkit-appearance: none; }
        button::-moz-focus-inner, input::-moz-focus-inner { border: 0; padding: 0; }
        textarea { overflow: auto; vertical-align: top; resize: vertical; }
        input:valid, textarea:valid {  }
        input:invalid, textarea:invalid { background-color: #f0dddd; }
        table { border-collapse: collapse; border-spacing: 0; }
        td { vertical-align: top; }

        body
        {
            font-family:'Droid Sans', sans-serif;
            font-size:10pt;
            color:#555;
            line-height: 25px;
        }

        .wrapper
        {
            width:760px;
            margin:0 auto 5em auto;
        }

        .main
        {
            overflow:hidden;
        }

        .error-spacer
        {
            height:4em;
        }

        a, a:visited
        {
            color:#2972A3;
        }

        a:hover
        {
            color:#72ADD4;
        }

        .row-fluid [class*="span"] {
          float: left;
          width: 100%;
          margin-left: 2.127659574468085%;
          *margin-left: 2.074468085106383%;
          -webkit-box-sizing: border-box;
             -moz-box-sizing: border-box;
                  box-sizing: border-box;
        }

        .row-fluid [class*="span"]:first-child {
          margin-left: 0;
        }

        .row-fluid .span12 {
          width: 100%;
          *width: 99.94680851063829%;
        }

        .row-fluid .span11 {
          width: 91.48936170212765%;
          *width: 91.43617021276594%;
        }

        .row-fluid .span10 {
          width: 82.97872340425532%;
          *width: 82.92553191489361%;
        }

        .row-fluid .span9 {
          width: 74.46808510638297%;
          *width: 74.41489361702126%;
        }

        .row-fluid .span8 {
          width: 65.95744680851064%;
          *width: 65.90425531914893%;
        }

        .row-fluid .span7 {
          width: 57.44680851063829%;
          *width: 57.39361702127659%;
        }

        .row-fluid .span6 {
          width: 48.93617021276595%;
          *width: 48.88297872340425%;
        }

        .row-fluid .span5 {
          width: 40.42553191489362%;
          *width: 40.37234042553192%;
        }

        .row-fluid .span4 {
          width: 31.914893617021278%;
          *width: 31.861702127659576%;
        }

        .row-fluid .span3 {
          width: 23.404255319148934%;
          *width: 23.351063829787233%;
        }

        .row-fluid .span2 {
          width: 14.893617021276595%;
          *width: 14.840425531914894%;
        }

        .row-fluid .span1 {
          width: 6.382978723404255%;
          *width: 6.329787234042553%;
        }

        .pull-right {
          float: right;
        }

        .pull-left {
          float: left;
        }


    </style>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

</head>
<body>
    <div class="wrapper">
        <div class="error-spacer"></div>
        <div role="main" class="main">
            <div class="row-fluid">
                <div class="span12">
                    <div class="span4">
                        <h1>{{ Config::get('cms.name') }}</h1>
                    </div>
                    <div class="span8">
                        <?php global $timer_start; ?>
                        <h2 class="pull-right">{{ $extra }}</h2>
                    </div>
                </div>
            <h2>Error: {{ $code }} ({{ $name }})</h2>
            <hr>

            <h3>What does this mean?</h3>

            <p>
                Something went wrong on our servers while we were processing your request.
                {{ $message }}
                This occurrence has been logged, and a highly trained team of monkeys has been
                dispatched to deal with your problem. We're really sorry about this, and will
                work hard to get this resolved as soon as possible.
            </p>

            <p>
                Perhaps you would like to go to our <a href="{{{ URL::route('base') }}}">home page</a>?
            </p>
        </div>
    </div>
</body>
</html>
