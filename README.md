Bootstrap-CMS
=============


Copyright © [Graham Campbell](https://github.com/GrahamCampbell) 2013  


[![Build Status](https://travis-ci.org/GrahamCampbell/Bootstrap-CMS.png?branch=master)](https://travis-ci.org/GrahamCampbell/Bootstrap-CMS)

## THIS ALPHA RELEASE IS FOR TESTING ONLY


## What Is Bootstrap CMS?

Bootstrap CMS is a PHP CMS powered by [Laravel 4.0](http://laravel.com) with [Sentry 2.0](http://docs.cartalyst.com/sentry-2).  

* Bootstrap CMS, in its current form, is maintained by [Graham Campbell](https://github.com/GrahamCampbell).  
* Bootstrap CMS will eventually use [Travis CI](https://travis-ci.org/GrahamCampbell/Bootstrap-CMS) to run tests to check if it's working as it should.  
* Bootstrap CMS uses [Composer](https://getcomposer.org) to load and manage dependencies.  
* Bootstrap CMS provides a [change log](https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/CHANGELOG.md) and a set of [releases](https://github.com/GrahamCampbell/Bootstrap-CMS/releases).  
* Bootstrap CMS is licensed under the GNU AGPLv3, available [here](https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md).  


## What Does Testing Release Mean?

Basically, expect no support what so ever. This includes, but is not exclusive to:  

* No support or help will be given during installation or updating.  
  * No database migration support between updates
  * Updates may not be backwards compatible
* Some of the config may be for features that don't exist yet.  
  * Some config may even brake the entire site
  * Just remember, this software comes WITHOUT ANY WARRANTY
* Technically, this software comes with no support after the testing stage either.  
  * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE
  * See the [GNU Affero General Public License](http://www.gnu.org/licenses/agpl-3.0.html) for more details


## System Requirements

Bootstrap CMS was designed to run on a Linux machine with PHP 5.4 and MySQL 5.5.  

* PHP 5.3.7+ or PHP 5.4+ is required. PHP 5.5+ may work, but is untested.  
* MySQL 5.1+, 5.5+, or 5.6+ is required. MySQL 5.7+ may work, but is untested.  
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Bootstrap CMS.  
* You will need to configure the site in the app/config folder before production.  
* Some features require a cache server like [Redis](http://redis.io) and a queuing server like [Beanstalkd](http://kr.github.io/beanstalkd).  


## Installation

Please check the system requirements before installing Bootstrap CMS.  

1. You may install by cloning from github, or via composer.  
  * Github: "git clone git@github.com:GrahamCampbell/Bootstrap-CMS.git"
  * Composer: "composer create-project gjc/bootstrap-cms"
2. From a command line open in the folder, run "composer install".  
3. Navigate to app/config, and adjust the config accordingly.  
  * If you don't want Boostrap CMS to send emails, you can disable that in cms.php
  * If you don't have a cache server like [Redis](http://redis.io), disable caching in cms.php
  * If you don't have a queuing server like [Beanstalkd](http://kr.github.io/beanstalkd), set queue.php to use "sync"
4. You can run "php artisan app:install" to setup and seed your database.  
  * Make sure you setup your database config in database.php. 
5. Finally, setup an [Apache VirtualHost](http://httpd.apache.org/docs/current/vhosts/examples.html) to point to the "public" folder.
  * For development, you can simply run "php artisan serve"


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


## License

Bootstrap CMS - A CMS Powered By Laravel 4  
Copyright (C) 2013  Graham Campbell  

This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.  

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.  
  
You should have received a copy of the GNU Affero General Public License along with this program.  If not, see http://www.gnu.org/licenses/.  
