<!DOCTYPE html>
<html lang="en-GB">

@include('partials.header')

<body>
    @include('partials.navigation')

    <div class="container">
        @include('partials.title')
        @section('controls')
        @show
        @include('partials.notifications')
        @section('content')
        @show
        <br><hr>
    </div>
    @include('partials.footer')
    </body>
</html>
