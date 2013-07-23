<!DOCTYPE html>
<html lang="en-GB">

@include('partials.header')

<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <a class="brand" href="{{ URL::route('base') }}">{{ Config::get('cms.name') }}</a>
                <div class="nav-collapse collapse">
                    @include('partials.navigation')
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if (isset($page))
            @if ($page->show_title == true)
                <div class="page-header">
                    <h1>
                        @section('title') 
                        @show
                    </h1>
                </div>
            @endif
        @else
            <div class="page-header">
                <h1>
                    @section('title') 
                    @show
                </h1>
            </div>
        @endif
        @include('partials.notifications')
        @section('content')
        @show
        <br><hr>
    </div>
    @include('partials.footer')
    </body>
</html>
