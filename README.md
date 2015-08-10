Bootstrap CMS
=============

Bootstrap CMS was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and is a PHP CMS powered by [Laravel 5.1](http://laravel.com) and [Sentry](https://cartalyst.com/manual/sentry). It utilises many of my packages including [Laravel Core](https://github.com/GrahamCampbell/Laravel-Core) and [Laravel Credentials](https://github.com/BootstrapCMS/Credentials). Feel free to check out the [releases](https://github.com/BootstrapCMS/CMS/releases), [license](LICENSE), [screenshots](SCREENSHOTS.md), and [contribution guidelines](CONTRIBUTING.md).

![Bootstrap CMS](https://cloud.githubusercontent.com/assets/2829600/4432327/c1ae6436-468c-11e4-84eb-4e5e546da3ff.PNG)

<p align="center">
<a href="https://travis-ci.org/BootstrapCMS/CMS"><img src="https://img.shields.io/travis/BootstrapCMS/CMS/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/BootstrapCMS/CMS/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/BootstrapCMS/CMS.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/BootstrapCMS/CMS"><img src="https://img.shields.io/scrutinizer/g/BootstrapCMS/CMS.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-AGPL%203.0-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/BootstrapCMS/CMS/releases"><img src="https://img.shields.io/github/release/BootstrapCMS/CMS.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

[PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.6+, a database server, and [Composer](https://getcomposer.org) are required.

1. There are 3 ways of grabbing the code:
  * Use GitHub: simply download the zip on the right of the readme
  * Use Git: `git clone git@github.com:BootstrapCMS/CMS.git`
  * Use Composer: `composer create-project graham-campbell/bootstrap-cms --prefer-dist -s dev`
2. From a command line open in the folder, run `composer install --no-dev -o` and then `npm install`.
3. Enter your database details into `config/database.php`.
4. Run `php artisan app:install` followed by `gulp --production` to setup the application.
5. You will need to enter your mail server details into `config/mail.php`.
  * You can disable verification emails in `config/credentials.php`
  * Mail is still required for other functions like password resets and the contact form
  * You must set the contact email in `config/contact.php`
  * I'd recommend [queuing](#setting-up-queing) email sending for greater performance (see below)
6. Finally, setup an [Apache VirtualHost](http://httpd.apache.org/docs/current/vhosts/examples.html) to point to the "public" folder.
  * For development, you can simply run `php artisan serve`


## Setting Up Queuing

Bootstrap CMS uses Laravel's queue system to offload jobs such as sending emails so your users don't have to wait for these activities to complete before their pages load. By default, we're using the "sync" queue driver.

1. Check out Laravel's [documentation](http://laravel.com/docs/master/queues#configuration).
2. Enter your queue server details into `config/queue.php`.


## Setting Up Caching

Bootstrap CMS provides caching functionality, and when enabled, requires a caching server.
Note that caching will not work with Laravel's `file` or `database` cache drivers.

1. Choose your poison - I'd recommend [Redis](http://redis.io).
2. Enter your cache server details into `config/cache.php`.
3. Setting the driver to array will effectively disable caching if you don't want the overhead.


## Setting Up Themes

Bootstrap CMS also ships with 18 themes, 16 from [Bootswatch](http://bootswatch.com).

1. You can set your theme in `config/theme.php`.
2. You can also set your navbar style in `config/theme.php`.
3. After making theme changes, you will have to run `php artisan app:update`.


## Setting Up Google Analytics

Bootstrap CMS natively supports [Google Analytics](http://www.google.com/analytics).

1. Setup a web property on [Google Analytics](http://www.google.com/analytics).
2. Enter your tracking id into `config/analytics.php`.
3. Enable Google Analytics in `config/analytics.php`.


## Setting Up CloudFlare Analytics

Bootstrap CMS can read [CloudFlare](https://www.cloudflare.com/) analytic data through a package.

1. Follow the install instructions for my [Laravel CloudFlare](https://github.com/BootstrapCMS/CloudFlare) package.
2. Bootstrap CMS will auto-detect the package, only allow admin access, and add links to the navigation bar.


## License

GNU AFFERO GENERAL PUBLIC LICENSE

Bootstrap CMS Is A PHP CMS Powered By Laravel 5 And Sentry

Copyright (C) 2013-2015 Graham Campbell

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
