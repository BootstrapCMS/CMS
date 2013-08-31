<?php namespace GrahamCampbell\BootstrapCMS;

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */

use Illuminate\Support\ServiceProvider;

class BootstrapCMSServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app['commentprovider'] = $this->app->share(function($app) {
            return new Providers\CommentProvider;
        });
        $this->app['eventprovider'] = $this->app->share(function($app) {
            return new Providers\EventProvider;
        });
        $this->app['groupprovider'] = $this->app->share(function($app) {
            return new Providers\GroupProvider;
        });
        $this->app['pageprovider'] = $this->app->share(function($app) {
            return new Providers\PageProvider;
        });
        $this->app['postprovider'] = $this->app->share(function($app) {
            return new Providers\PostProvider;
        });
        $this->app['userprovider'] = $this->app->share(function($app) {
            return new Providers\UserProvider;
        });
        $this->app['navigation'] = $this->app->share(function($app) {
            return new Classes\Navigation;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array('commentprovider', 'eventprovider', 'groupprovider', 'pageprovider', 'postprovider', 'userprovider', 'navigation');
    }
}
