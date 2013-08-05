<?php

class PagesTableSeeder extends Seeder {

    /**
     * Run the database seeding.
     */
    public function run() {
        DB::table('pages')->delete();

        $home = array(
            'title' => 'Home',
            'slug'  => 'home',
            'body'  => '<div class="jumbotron">
    <h1><?php echo Config::get("cms.name"); ?></h1>
    <p class="lead">Powered by Laravel 4 with Sentry 2</p>
    <a class="btn btn-large btn-success" href="<?php echo URL::route("account.register"); ?>">Sign Up Today</a>
</div>

<hr>

<div class="row-fluid">

    <div class="span4">
        <h2>Welcome</h2>
        <p>Bootstrap Site is a Bootstrap based website template featuring a protected members section. It was created by, and is maintained by Graham Campbell.</p>
        <p>
            <a class="btn" href="<?php echo URL::route("pages.show", array("pages" => "about")); ?>">View details &raquo;</a>
        </p>
    </div>

    <div class="span4">
        <h2>Forking</h2>
        <p>Feel free to fork this project and use it anywhere you want, in compliance with the license. Before submitting a pull request, you should ensure that your fork is up to date.</p>
        <p>
            <a class="btn" href="<?php echo URL::route("pages.show", array("pages" => "about")); ?>">View details &raquo;</a>
        </p>
    </div>

    <div class="span4">
        <h2>Credits</h2>
        <p>This template was made by Graham Campbell. It is powered by laravel 4 with Sentry 2. Credit to the Bootstrap and jQuery teams, also.</p>
        <p>
            <a class="btn" href="<?php echo URL::route("pages.show", array("pages" => "about")); ?>">View details &raquo;</a>
        </p>
    </div>

</div>',
            'show_title' => false,
            'icon'       => 'icon-home',
            'user_id'    => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        );

        DB::table('pages')->insert($home);

        $about = array(
            'title' => 'About',
            'slug'  => 'about',
            'body'  => '<p class="lead">
    This is the about page!
</p>',
            'user_id'    => 1,
            'icon'       => 'icon-info-sign',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        );

        DB::table('pages')->insert($about);
    }
}
