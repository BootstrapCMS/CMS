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
        <p>Bootstrap CMS is a PHP CMS powered by <a href="http://laravel.com">Laravel 4.0</a> with <a href="http://docs.cartalyst.com/sentry-2">Sentry 2.0</a>. It was created by, and is maintained by <a href="https://github.com/GrahamCampbell">Graham Campbell<a>.</p>
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
        <p>Bootstrap CMS leverages queuing and caching to keep it fast and smooth, while the front end would also not be possible without <a href="http://getbootstrap.com">Bootstrap</a> and <a href"http://jquery.com">jQuery</a>.</p>
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
            'body'  => '<div class="row-fluid"><div class="span8">
<h2>What Is Bootstrap CMS?</h2>

<p>Bootstrap CMS is a PHP CMS powered by <a href="http://laravel.com">Laravel 4.0</a> with <a href="http://docs.cartalyst.com/sentry-2">Sentry 2.0</a>.</p>

<ul>
<li>Bootstrap CMS was created by, and is maintained by <a href="https://github.com/GrahamCampbell">Graham Campbell</a>.  </li>
<li>Bootstrap CMS uses <a href="https://travis-ci.org/GrahamCampbell/Bootstrap-CMS">Travis CI</a> to run tests to check if it\'s working as it should.  </li>
<li>Bootstrap CMS uses <a href="https://scrutinizer-ci.com/g/GrahamCampbell/Bootstrap-CMS">Scrutinizer CI</a> to run additional tests and checks.  </li>
<li>Bootstrap CMS uses <a href="https://getcomposer.org">Composer</a> to load and manage dependencies.  </li>
<li>Bootstrap CMS provides a <a href="https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/CHANGELOG.md">change log</a>, <a href="https://github.com/GrahamCampbell/Bootstrap-CMS/releases">releases</a>, and a <a href="https://github.com/GrahamCampbell/Bootstrap-CMS/wiki">wiki</a>.  </li>
<li>Bootstrap CMS is licensed under the GNU AGPLv3, available <a href="https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md">here</a>.  </li>
</ul>

<br><h2>What Does Testing Release Mean?</h2>

<p>Basically, expect no support what so ever. This includes, but is not exclusive to:</p>

<ul>
<li>No support or help will be given during installation or updating. <br />
<ul><li>No database migration support between updates</li>
<li>Updates may not be backwards compatible</li></ul></li>
<li>Some of the config may be for features that don\'t exist yet. <br />
<ul><li>Some config may even brake the entire site</li>
<li>Just remember, this software comes WITHOUT ANY WARRANTY</li></ul></li>
<li>Technically, this software comes with no support after the testing stage either. <br />
<ul><li>This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE</li>
<li>See the <a href="http://www.gnu.org/licenses/agpl-3.0.html">GNU Affero General Public License</a> for more details</li></ul></li>
</ul>

<br><h2>System Requirements</h2>

<p>Bootstrap CMS was designed to run on a Linux machine with PHP 5.4 and MySQL 5.5.</p>

<ul>
<li>PHP 5.4.7+ or PHP 5.5+ is required.</li>
<li>MySQL 5.1+, 5.5+, or 5.6+ is required. MySQL 5.7+ may work, but is untested.  </li>
<li>You will need <a href="https://getcomposer.org">Composer</a> installed to load the dependencies of Bootstrap CMS.  </li>
<li>You will need to configure the site in the app/config folder before production.  </li>
<li>Some features require a cache server like <a href="http://redis.io">Redis</a> and a queuing server like <a href="http://kr.github.io/beanstalkd">Beanstalkd</a>.  </li>
</ul>

<br><h2>Installation</h2>

<p>Please check the system requirements before installing Bootstrap CMS.</p>

<ol>
<li>You may install by cloning from github, or via composer. <br />
<ul><li>Github: <code>git clone git@github.com:GrahamCampbell/Bootstrap-CMS.git</code></li>
<li>Composer: <code>composer create-project graham-campbell/bootstrap-cms --prefer-dist</code></li></ul></li>
<li>From a command line open in the folder, run <code>composer install</code>.  </li>
<li>Navigate to <code>app/config</code>, and adjust the config accordingly. <br />
<ul><li>If you don\'t want Boostrap CMS to send emails, you can disable that in cms.php</li>
<li>If you don\'t have a cache server like <a href="http://redis.io">Redis</a>, disable caching in cms.php</li>
<li>If you don\'t have a queuing server like <a href="http://kr.github.io/beanstalkd">Beanstalkd</a>, set queue.php to use "sync"</li></ul></li>
<li>You can run <code>php artisan app:install</code> to setup and seed your database. <br />
<ul><li>Make sure you setup your database config in database.php. </li></ul></li>
<li>Finally, setup an <a href="http://httpd.apache.org/docs/current/vhosts/examples.html">Apache VirtualHost</a> to point to the "public" folder.
<ul><li>For development, you can simply run <code>php artisan serve</code></li></ul></li>
</ol>

<br><h2>Updating Your Fork</h2>

<p>The latest and greatest source can be found on <a href="https://github.com/GrahamCampbell/Bootstrap-CMS">GitHub</a>. <br />
Before submitting a pull request, you should ensure that your fork is up to date.</p>

<p>You may fork Bootstrap CMS:</p>

<pre><code>git remote add upstream git://github.com/GrahamCampbell/Bootstrap-CMS.git
</code></pre>

<p>The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as <a href="http://perforce.com/product/components/perforce_visual_merge_and_diff_tools">P4Merge</a>.</p>

<p>You can then update the branch:</p>

<pre><code>git pull --rebase upstream master
git push --force origin &lt;branch_name&gt;
</code></pre>

<p>Once it is set up, run <code>git mergetool</code>. Once all conflicts are fixed, run <code>git rebase --continue</code>, and <code>git push --force origin &lt;branch_name&gt;</code>.</p>

<br><h2>License</h2>

<p>Bootstrap CMS - A CMS Powered By Laravel 4 <br />
Copyright (C) 2013  Graham Campbell</p>

<p>This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.</p>

<p>This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.</p>

<p>You should have received a copy of the GNU Affero General Public License along with this program.  If not, see http://www.gnu.org/licenses/.</p>
</div></div>',
            'user_id'    => 1,
            'icon'       => 'icon-info-sign',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        );

        DB::table('pages')->insert($about);
    }
}
