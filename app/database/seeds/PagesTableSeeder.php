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
            'body'  => '<div class="row-fluid"><div class="span8">'.Markdown::string('
## What Is Bootstrap CMS?

Bootstrap CMS is a PHP CMS powered by [Laravel 4.0](http://laravel.com) with [Sentry 2.0](http://docs.cartalyst.com/sentry-2).  

* Bootstrap CMS was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).  
* Bootstrap CMS uses [Travis CI](https://travis-ci.org/GrahamCampbell/Bootstrap-CMS) to run tests to check if it\'s working as it should.  
* Bootstrap CMS uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/Bootstrap-CMS) to run additional tests and checks.  
* Bootstrap CMS uses [Composer](https://getcomposer.org) to load and manage dependencies.  
* Bootstrap CMS provides a [change log](https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Bootstrap-CMS/releases), and a [wiki](https://github.com/GrahamCampbell/Bootstrap-CMS/wiki).  
* Bootstrap CMS is licensed under the GNU AGPLv3, available [here](https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md).  

<br>

## What Does Testing Release Mean?

Basically, expect no support what so ever. This includes, but is not exclusive to:  

* No support or help will be given during installation or updating.  
  * No database migration support between updates
  * Updates may not be backwards compatible
* Some of the config may be for features that don\'t exist yet.  
  * Some config may even brake the entire site
  * Just remember, this software comes WITHOUT ANY WARRANTY
* Technically, this software comes with no support after the testing stage either.  
  * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE
  * See the [GNU Affero General Public License](http://www.gnu.org/licenses/agpl-3.0.html) for more details

<br>

## System Requirements

Bootstrap CMS was designed to run on a Linux machine with PHP 5.4 and MySQL 5.5.  

* PHP 5.4.7+ or PHP 5.5+ is required.
* MySQL 5.1+, 5.5+, or 5.6+ is required. MySQL 5.7+ may work, but is untested.  
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Bootstrap CMS.  
* You will need to configure the site in the app/config folder before production.  
* Some features require a cache server like [Redis](http://redis.io) and a queuing server like [Beanstalkd](http://kr.github.io/beanstalkd).  

<br>

## Installation

Please check the system requirements before installing Bootstrap CMS.  

1. You may install by cloning from github, or via composer.  
  * Github: `git clone git@github.com:GrahamCampbell/Bootstrap-CMS.git`
  * Composer: `composer create-project graham-campbell/bootstrap-cms --prefer-dist`
2. From a command line open in the folder, run `composer install`.  
3. Enter your database details into `app/config/databse.php`.  
4. You can run `php artisan app:install` to setup and seed your database.  
  * Make sure you setup your database config in database.php. 
5. Finally, setup an [Apache VirtualHost](http://httpd.apache.org/docs/current/vhosts/examples.html) to point to the "public" folder.
  * For development, you can simply run `php artisan serve`
6. Additionally, you may to setup queuing and/or caching (see below).  

<br>

## Getting Queuing Working

Note that `beanstalkd` requires a local server, while `sqs` and `iron` are cloud based.  

1. Choose your poison - I\'d recommend [IronMQ](http://www.iron.io/mq).  
2. Enter your queuing server details into `app/config/queue.php`.  
3. You can also set a separate mail queue in `app/config/mail.php`.  

<br>

## Getting Caching Working

Note that caching will not work with Laravel\'s `file` or `database` cache drivers.  

1. Choose your poison - I\'d recommend [Redis](http://redis.io).  
2. Enter your cache server details into `app/config/cache.php`.  
3. Enable Bootstrap CMS\'s caching in `app/config/cms.php`.  

<br>

## Getting Google Analytics Working

Bootstrap CMS natively supports Google Analytics.  

1. Setup a web property on Google Anaytics.  
2. Enter your tracking id into `app/config/analytics.php`.  
3. Enable Google Analytics in `app/config/analytics.php`.  

<br>

## Getting Themes Working

Bootstrap CMS also ships with 13 themes from Bootswatch.  

1. You can set your theme in `app/config/theme.php`.  
2. You can also set your nav bar style in `app/config/theme.php`.  
3. After making theme changes, you will have to run `php artisan app:update`.  

<br>

## Updating Your Fork

The latest and greatest source can be found on [GitHub](https://github.com/GrahamCampbell/Bootstrap-CMS).  
Before submitting a pull request, you should ensure that your fork is up to date.  

You may fork Bootstrap CMS:  

    git remote add upstream git://github.com/GrahamCampbell/Bootstrap-CMS.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).  

You can then update the branch:  

    git pull --rebase upstream master
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.  

<br>

## License

Bootstrap CMS - A CMS Powered By Laravel 4  
Copyright (C) 2013  Graham Campbell  

This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.  

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.  
  
You should have received a copy of the GNU Affero General Public License along with this program.  If not, see http://www.gnu.org/licenses/.  
').'</div></div>',
            'user_id'    => 1,
            'icon'       => 'icon-info-sign',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        );

        DB::table('pages')->insert($about);
    }
}
