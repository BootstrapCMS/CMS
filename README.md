Bootstrap CMS
=============

Bootstrap CMS was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a PHP CMS powered by [Laravel 5.0](http://laravel.com) and [Sentry](https://cartalyst.com/manual/sentry). It utilises 12 of my packages including [Laravel Core](https://github.com/GrahamCampbell/Laravel-Core) and [Laravel Credentials](https://github.com/GrahamCampbell/Laravel-Credentials). Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Bootstrap-CMS/releases), [license](LICENSE.md), [screenshots](SCREENSHOTS.md), [api docs](http://docs.grahamjcampbell.co.uk), and [contribution guidelines](CONTRIBUTING.md).

![Bootstrap CMS](https://cloud.githubusercontent.com/assets/2829600/4432327/c1ae6436-468c-11e4-84eb-4e5e546da3ff.PNG)

<p align="center">
<a href="https://travis-ci.org/GrahamCampbell/Bootstrap-CMS"><img src="https://img.shields.io/travis/GrahamCampbell/Bootstrap-CMS/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Bootstrap-CMS/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Bootstrap-CMS.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Bootstrap-CMS"><img src="https://img.shields.io/scrutinizer/g/GrahamCampbell/Bootstrap-CMS.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE.md"><img src="https://img.shields.io/badge/license-AGPL%203.0-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/GrahamCampbell/Bootstrap-CMS/releases"><img src="https://img.shields.io/github/release/GrahamCampbell/Bootstrap-CMS.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

[PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.3+, a database server, and [Composer](https://getcomposer.org) are required.

1. There are 3 ways of grabbing the code:
  * Use GitHub: simply download the zip on the right of the readme
  * Use Git: `git clone git@github.com:GrahamCampbell/Bootstrap-CMS.git`
  * Use Composer: `composer create-project graham-campbell/bootstrap-cms --prefer-dist -s dev`
2. From a command line open in the folder, run `composer install --no-dev -o`.
3. Enter your database details into `config/database.php`.
4. Run `php artisan app:install` to setup and seed your database.
5. You will need to enter your mail server details into `config/mail.php`.
  * You can disable verification emails in `config/packages/graham-campbell/navigation/config.php`
  * Mail is still required for other functions like password resets and the contact form
  * You must set the contact email in `config/packages/graham-campbell/contact/config.php`
  * I'd recommend [queuing](#setting-up-queing) email sending for greater performance (see below)
6. Finally, setup an [Apache VirtualHost](http://httpd.apache.org/docs/current/vhosts/examples.html) to point to the "public" folder.
  * For development, you can simply run `php artisan serve`
7. Additionally, you may to setup some of Bootstrap CMS's other features (see below).
  * Some things, like [caching](#setting-up-caching) and [queuing](#setting-up-queing), are disabled out of the box
  * This is to allow Bootstrap CMS to work with minimal setup
  * Also note, without caching asset generation will cause page load delay - to reduce this, I have turned off minification in `config/packages/lightgear/asset/config.php` by default


## Setting Up Queuing

Bootstrap CMS allows you to use any of Laravel's queue drivers, but by default, will use the async driver provided by Barry vd. Heuvel's [Async Queue Driver](https://github.com/barryvdh/laravel-async-queue) package.

1. Enter your queue server details into `config/queue.php`.
2. If you're using the `sync` driver or the `async` driver, your done here.
3. If you're using one of the other drivers, check out the Laravel docs.


## Setting Up Caching

Bootstrap CMS provides caching functionality, and when enabled, requires a caching server.
Note that caching will not work with Laravel's `file` or `database` cache drivers.

1. Choose your poison - I'd recommend [Redis](http://redis.io).
2. Enter your cache server details into `config/cache.php`.
3. You will probably want to enabled minification in `config/packages/lightgear/asset/config.php`.
4. Setting the driver to array will effectively disable caching if you don't want the overhead.


## Setting Up Themes

Bootstrap CMS also ships with 18 themes, 16 from [Bootswatch](http://bootswatch.com).

1. You can set your theme in `config/theme.php`.
2. You can also set your nav bar style in `config/theme.php`.
3. After making theme changes, you will have to run `php artisan app:update`.


## Setting Up Google Analytics

Bootstrap CMS natively supports [Google Analytics](http://www.google.com/analytics).

1. Setup a web property on [Google Analytics](http://www.google.com/analytics).
2. Enter your tracking id into `config/analytics.php`.
3. Enable Google Analytics in `config/analytics.php`.


## Setting Up CloudFlare Analytics

Bootstrap CMS can read [CloudFlare](https://www.cloudflare.com/) analytic data through a package.

1. Follow the install instructions for my [Laravel CloudFlare](https://github.com/GrahamCampbell/Laravel-CloudFlare) package.
2. Remember to add your credentials to `config/packages/graham-campbell/cloudflare-api/config.php`.
3. Bootstrap CMS will auto-detect the package, only allow admin access, and add links to the navigation bar.


## License

GNU AFFERO GENERAL PUBLIC LICENSE

Bootstrap CMS Is A PHP CMS Powered By Laravel 5 And Sentry

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
