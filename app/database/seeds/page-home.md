<div class="jumbotron">
    <h1><?php echo Config::get("cms.name"); ?></h1>
    <p class="lead">Powered by Laravel 4 with Sentry 2</p>
    <a class="btn btn-large btn-success" href="<?php echo URL::route("account.register"); ?>">Sign Up Today</a>
</div>

<hr>

<div class="row-fluid">

    <div class="span4">
        <h2>Welcome</h2>
        <p>Bootstrap CMS is a PHP CMS powered by <a href="http://laravel.com">Laravel 4.0</a> with <a href="http://docs.cartalyst.com/sentry-2">Sentry 2.0</a>. Bootstrap CMS was created by, and is maintained by <a href="https://github.com/GrahamCampbell">Graham Campbell<a>.</p>
        <p>
            <a class="btn" href="<?php echo URL::route("pages.show", array("pages" => "about")); ?>">View details &raquo;</a>
        </p>
    </div>

    <div class="span4">
        <h2>Forking</h2>
        <p>Feel free to fork this project and use it anywhere you want, in compliance with the <a href="https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md">license</a>. Before submitting a pull request, you should ensure that your fork is up to date.</p>
        <p>
            <a class="btn" href="<?php echo URL::route("pages.show", array("pages" => "about")); ?>">View details &raquo;</a>
        </p>
    </div>

    <div class="span4">
        <h2>More</h2>
        <p>The back-end leverages queuing and caching to keep it fast and smooth, while the front-end would also not be possible without <a href="http://getbootstrap.com">Bootstrap</a> and <a href"http://jquery.com">jQuery</a>.</p>
        <p>
            <a class="btn" href="<?php echo URL::route("pages.show", array("pages" => "about")); ?>">View details &raquo;</a>
        </p>
    </div>

</div>
