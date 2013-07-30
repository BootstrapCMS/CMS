<!DOCTYPE html>
<html lang="en-GB">

    @include('partials.header')

    <body>

        @include('partials.navigation')

        <div class="container">
            @include('partials.title')
            @include('partials.notifications')
            @section('controls')
            @show
            @section('content')
            @show
            <br><hr>
        </div>
        @include('partials.footer')

    </body>

</html>
