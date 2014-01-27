<?php

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
 */

namespace GrahamCampbell\BootstrapCMS;

use Illuminate\Support\ServiceProvider;

/**
 * This is the bootstrap cms service provider class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class BootstrapCMSServiceProvider extends ServiceProvider
{
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
    public function boot()
    {
        $this->package('graham-campbell/bootstrap-cms');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCachingController();
        $this->registerCommentController();
        $this->registerEventController();
        $this->registerFileController();
        $this->registerFolderController();
        $this->registerHomeController();
        $this->registerPageController();
        $this->registerPostController();
        $this->registerQueuingController();
    }

    /**
     * Register the caching controller class.
     *
     * @return void
     */
    protected function registerCachingController()
    {
        $this->app->bind('GrahamCampbell\BootstrapCMS\Controllers\CachingController', function ($app) {
            $credentials = $app['credentials'];

            return new Controllers\CachingController($credentials);
        });
    }

    /**
     * Register the comment controller class.
     *
     * @return void
     */
    protected function registerCommentController()
    {
        $this->app->bind('GrahamCampbell\BootstrapCMS\Controllers\CommentController', function ($app) {
            $credentials = $app['credentials'];

            return new Controllers\CommentController($credentials);
        });
    }

    /**
     * Register the event controller class.
     *
     * @return void
     */
    protected function registerEventController()
    {
        $this->app->bind('GrahamCampbell\BootstrapCMS\Controllers\EventController', function ($app) {
            $credentials = $app['credentials'];

            return new Controllers\EventController($credentials);
        });
    }

    /**
     * Register the file controller class.
     *
     * @return void
     */
    protected function registerFileController()
    {
        $this->app->bind('GrahamCampbell\BootstrapCMS\Controllers\FileController', function ($app) {
            $credentials = $app['credentials'];

            return new Controllers\FileController($credentials);
        });
    }

    /**
     * Register the folder controller class.
     *
     * @return void
     */
    protected function registerFolderController()
    {
        $this->app->bind('GrahamCampbell\BootstrapCMS\Controllers\FolderController', function ($app) {
            $credentials = $app['credentials'];

            return new Controllers\FolderController($credentials);
        });
    }

    /**
     * Register the home controller class.
     *
     * @return void
     */
    protected function registerHomeController()
    {
        $this->app->bind('GrahamCampbell\BootstrapCMS\Controllers\HomeController', function ($app) {
            $credentials = $app['credentials'];

            return new Controllers\HomeController($credentials);
        });
    }

    /**
     * Register the page controller class.
     *
     * @return void
     */
    protected function registerPageController()
    {
        $this->app->bind('GrahamCampbell\BootstrapCMS\Controllers\PageController', function ($app) {
            $credentials = $app['credentials'];

            return new Controllers\PageCachingController($credentials);
        });
    }

    /**
     * Register the post controller class.
     *
     * @return void
     */
    protected function registerPostController()
    {
        $this->app->bind('GrahamCampbell\BootstrapCMS\Controllers\PostController', function ($app) {
            $credentials = $app['credentials'];

            return new Controllers\PostController($credentials);
        });
    }

    /**
     * Register the queuing controller class.
     *
     * @return void
     */
    protected function registerQueuingController()
    {
        $this->app->bind('GrahamCampbell\BootstrapCMS\Controllers\QueuingController', function ($app) {
            $credentials = $app['credentials'];

            return new Controllers\QueuingController($credentials);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            //
        );
    }
}
