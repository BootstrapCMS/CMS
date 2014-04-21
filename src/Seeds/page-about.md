## What Is Bootstrap CMS?

Bootstrap CMS is a PHP CMS powered by [Laravel 4.1](http://laravel.com) and [Sentry 2.1](https://cartalyst.com/manual/sentry).

* Bootstrap CMS was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).
* Bootstrap CMS relies on many of my packages including [Laravel Core](https://github.com/GrahamCampbell/Laravel-Core) and [Laravel Queuing](https://github.com/GrahamCampbell/Laravel-Queuing).
* Bootstrap CMS uses [Travis CI](https://travis-ci.org/GrahamCampbell/Bootstrap-CMS) with [Coveralls](https://coveralls.io/r/GrahamCampbell/Bootstrap-CMS) to check everything is working.
* Bootstrap CMS uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/Bootstrap-CMS) and [SensioLabsInsight](https://insight.sensiolabs.com/projects/9eb79f92-a80a-46dc-9a3d-726c0ecc4162) to run additional checks.
* Bootstrap CMS uses [Composer](https://getcomposer.org) to load and manage dependencies.
* Bootstrap CMS provides a [change log](https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Bootstrap-CMS/releases), and [api docs](http://grahamcampbell.github.io/Bootstrap-CMS).
* Bootstrap CMS is licensed under the GNU AGPLv3, available [here](https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md).
* Licenses for included components are available [here](https://github.com/GrahamCampbell/Bootstrap-CMS/tree/master/licenses), excluding [Composer](https://getcomposer.org) installed components.

<br>

## System Requirements

Bootstrap CMS was designed to run on a Linux machine with PHP 5.5 and MySQL 5.5.

* PHP 5.4.7+ or HHVM 3.0+.
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Bootstrap CMS.
* You will need to configure the site in the app/config folder before production.
* Some features require a cache server like [Redis](http://redis.io) and a queuing server like [Beanstalkd](http://kr.github.io/beanstalkd).

<br>

## Installation

Please check the system requirements before installing Bootstrap CMS.

1. You may install by cloning from github, or via composer.
  * Github: `git clone git@github.com:GrahamCampbell/Bootstrap-CMS.git`
  * Composer: `composer create-project graham-campbell/bootstrap-cms --prefer-dist -s dev`
2. See the [Laravel Queuing](https://github.com/GrahamCampbell/Laravel-Queuing) readme for extra requirements before continuing.
3. From a command line open in the folder, run `composer install`.
4. Enter your database details into `app/config/databse.php`.
5. Run `php artisan app:install` to setup and seed your database.
6. You will need to enter your mail server details into `app/config/mail.php`.
  * You can disable verification emails in `app/config/packages/graham-campbell/navigation/config.php`
  * Mail is still required for other functions like password resets and the contact form
  * You must set the contact email in `app/config/packages/graham-campbell/contact/config.php`
  * I'd recommend [queuing](#setting-up-queing) email sending for greater performance (see below)
7. Finally, setup an [Apache VirtualHost](http://httpd.apache.org/docs/current/vhosts/examples.html) to point to the "public" folder.
  * For development, you can simply run `php artisan serve`
8. Additionally, you may to setup some of Bootstrap CMS's other features (see below).
  * Some things, like [caching](#setting-up-caching) and [queuing](#setting-up-queing), are disabled out of the box
  * This is to allow Bootstrap CMS to work with minimal setup
  * Please note that queuing is required in order to use the cron functionality which can do things like notify users of upcoming events, or send out weekly activity digests
  * Also note, without caching asset generation will cause page load delay - to reduce this, I have turned off minification in `app/config/packages/lightgear/asset/config.php` by default

<br>

## Setting Up Queuing

Bootstrap CMS provides queuing functionality, and when enabled, requires 3 separate queues.

  * One queue (the mail queue) will be used for sending emails
  * One queue (the cron queue) will be used for all cron jobs
  * One queue (the default queue) will be used for all other jobs
  * These queues must be separate to avoid unexpected functionality

Note that `beanstalkd` requires a local server, while `sqs` and `iron` are cloud based.
Also note that `sqs` and `redis` support is not 100% complete and is mainly untested.

For most uses, sync queuing will actually by sufficient because the queuing package will execute the jobs after the response has been sent (on application shutdown), so the end user will see no slowdown, we just won't be able to re-entry failed jobs.

1. Choose your poison - I'd recommend [IronMQ](http://www.iron.io/mq).
2. Enter your queuing server details into `app/config/queue.php`.
3. You can also set a separate mail queue in `app/config/mail.php`.
4. For [IronMQ](http://www.iron.io/mq), you can run the command `php artisan queue:iron`, and the `php artisan cron:start`.
5. You can find out more about queuing by heading over to the [Laravel Docs](http://laravel.com/docs/queues).

<br>

## Setting Up Caching

Bootstrap CMS provides caching functionality, and when enabled, requires a caching server.
Note that caching will not work with Laravel's `file` or `database` cache drivers.

1. Choose your poison - I'd recommend [Redis](http://redis.io).
2. Enter your cache server details into `app/config/cache.php`.
3. You will probably want to enabled minification in `app/config/packages/lightgear/asset/config.php`.
4. Setting the driver to array will effectively disable caching if you don't want the overhead.

<br>

## Setting Up Themes

Bootstrap CMS also ships with 17 themes, 15 from [Bootswatch](http://bootswatch.com).

1. You can set your theme in `app/config/theme.php`.
2. You can also set your nav bar style in `app/config/theme.php`.
3. After making theme changes, you will have to run `php artisan app:update`.

<br>

## Setting Up Google Analytics

Bootstrap CMS natively supports [Google Analytics](http://www.google.com/analytics).

1. Setup a web property on [Google Analytics](http://www.google.com/analytics).
2. Enter your tracking id into `app/config/analytics.php`.
3. Enable Google Analytics in `app/config/analytics.php`.

<br>

## Setting Up CloudFlare Analytics

Bootstrap CMS can read [CloudFlare](https://www.cloudflare.com/) analytic data through a package.

1. Follow the install instructions for my [Laravel CloudFlare](https://github.com/GrahamCampbell/Laravel-CloudFlare) package.
2. Remember to add your credentials to `app/config/packages/graham-campbell/cloudflare-api/config.php`.
3. Bootstrap CMS will auto-detect the package, only allow admin access, and add links to the navigation bar.

<br>

## Usage

There is currently no usage documentation besides the [API Documentation](http://grahamcampbell.github.io/Bootstrap-CMS) for Bootstrap CMS.

<br>

## Updating Your Fork

Before submitting a pull request, you should ensure that your fork is up to date.

You may fork Bootstrap CMS:

    git remote add upstream git://github.com/GrahamCampbell/Bootstrap-CMS.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).

You can then update the branch:

    git pull --rebase upstream master
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.

<br>

## Pull Requests

Please review these guidelines before submitting any pull requests.

* When submitting bug fixes, check if a maintenance branch exists for an older series, then pull against that older branch if the bug is present in it.
* Before sending a pull request for a new feature, you should first create an issue with [Proposal] in the title.
* Please follow the [PSR-2 Coding Style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and [PHP-FIG Naming Conventions](https://github.com/php-fig/fig-standards/blob/master/bylaws/002-psr-naming-conventions.md).

<br>

## License

GNU AFFERO GENERAL PUBLIC LICENSE

Bootstrap CMS Is A PHP CMS Powered By Laravel And Sentry 2.1
Copyright (C) 2013-2014  Graham Campbell

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
