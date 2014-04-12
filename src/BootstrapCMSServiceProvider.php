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
        $this->package('graham-campbell/bootstrap-cms', 'graham-campbell/bootstrap-cms', __DIR__);

        $this->setupViewer();
    }

    /**
     * Setup the viewer class.
     *
     * @return void
     */
    protected function setupViewer()
    {
        $this->app->bindShared('viewer', function ($app) {
            $view = $app['view'];
            $credentials = $app['credentials'];
            $navigation = $app['navigation'];
            $name = $app['config']['platform.name'];
            $inverse = $app['config']['theme.inverse'];

            return new Classes\Viewer($view, $credentials, $navigation, $name, $inverse);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommentProvider();
        $this->registerEventProvider();
        $this->registerPageProvider();
        $this->registerPostProvider();
        $this->registerCommandSubscriber();
        $this->registerCoreSubscriber();
        $this->registerNavigationSubscriber();
        $this->registerUserSubscriber();
        $this->registerCachingController();
        $this->registerCommentController();
        $this->registerEventController();
        $this->registerHomeController();
        $this->registerPageController();
        $this->registerPostController();
        $this->registerQueuingController();
    }

    /**
     * Register the comment provider class.
     *
     * @return void
     */
    protected function registerCommentProvider()
    {
        $this->app->bindShared('commentprovider', function ($app) {
            $model = $app['config']['cms.comment'];
            $comment = new $model();

            return new Providers\CommentProvider($comment);
        });
    }

    /**
     * Register the event provider class.
     *
     * @return void
     */
    protected function registerEventProvider()
    {
        $this->app->bindShared('eventprovider', function ($app) {
            $model = $app['config']['cms.event'];
            $event = new $model();

            return new Providers\EventProvider($event);
        });
    }

    /**
     * Register the page provider class.
     *
     * @return void
     */
    protected function registerPageProvider()
    {
        $this->app->bindShared('pageprovider', function ($app) {
            $model = $app['config']['cms.page'];
            $page = new $model();

            return new Providers\PageProvider($page);
        });
    }

    /**
     * Register the post provider class.
     *
     * @return void
     */
    protected function registerPostProvider()
    {
        $this->app->bindShared('postprovider', function ($app) {
            $model = $app['config']['cms.post'];
            $post = new $model();

            return new Providers\PostProvider($post);
        });
    }

    /**
     * Register the command subscriber class.
     *
     * @return void
     */
    protected function registerCommandSubscriber()
    {
        $this->app->bindShared('GrahamCampbell\BootstrapCMS\Subscribers\CommandSubscriber', function ($app) {
            $pageprovider = $app['pageprovider'];

            return new Subscribers\CommandSubscriber($pageprovider);
        });
    }

    /**
     * Register the core subscriber class.
     *
     * @return void
     */
    protected function registerCoreSubscriber()
    {
        $this->app->bindShared('GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber', function ($app) {
            $config = $app['config'];
            $log = $app['log'];

            return new Subscribers\CoreSubscriber($config, $log);
        });
    }

    /**
     * Register the navigation subscriber class.
     *
     * @return void
     */
    protected function registerNavigationSubscriber()
    {
        $this->app->bindShared('GrahamCampbell\Credentials\Subscribers\NavigationSubscriber', function ($app) {
            $config = $app['config'];
            $navigation = $app['navigation'];
            $credentials = $app['credentials'];
            $pageprovider = $app['pageprovider'];

            return new Subscribers\NavigationSubscriber($config, $navigation, $credentials, $pageprovider);
        });
    }

    /**
     * Register the user subscriber class.
     *
     * @return void
     */
    protected function registerUserSubscriber()
    {
        $this->app->bindShared('GrahamCampbell\Credentials\Subscribers\UserSubscriber', function ($app) {
            $log = $app['log'];

            return new Subscribers\UserSubscriber($log);
        });
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
            $viewer = $app['viewer'];

            return new Controllers\CachingController($credentials, $viewer);
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
            $session = $app['session'];
            $binput = $app['binput'];
            $htmlmin = $app['htmlmin'];
            $commentprovider = $app['commentprovider'];
            $postprovider = $app['postprovider'];

            return new Controllers\CommentController($credentials, $session, $binput, $htmlmin, $commentprovider, $postprovider);
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
            $viewer = $app['viewer'];
            $session = $app['session'];
            $binput = $app['binput'];
            $eventprovider = $app['eventprovider'];

            return new Controllers\EventController($credentials, $viewer, $session, $binput, $eventprovider);
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
            $viewer = $app['viewer'];
            $queuing = $app['queuing'];
            $email = $app['config']['workbench.email'];
            $subject = $app['config']['platform.name'].' - Welcome';

            return new Controllers\HomeController($credentials, $viewer, $queuing, $email, $subject);
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
            $viewer = $app['viewer'];
            $session = $app['session'];
            $binput = $app['binput'];
            $pageprovider = $app['pageprovider'];

            return new Controllers\PageController($credentials, $viewer, $session, $binput, $pageprovider);
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
            $viewer = $app['viewer'];
            $session = $app['session'];
            $binput = $app['binput'];
            $postprovider = $app['postprovider'];

            return new Controllers\PostController($credentials, $viewer, $session, $binput, $postprovider);
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
            $viewer = $app['viewer'];

            return new Controllers\QueuingController($credentials, $viewer);
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
            'commentprovider',
            'eventprovider',
            'fileprovider',
            'folderprovider',
            'pageprovider',
            'postprovider',
            'viewer'
        );
    }
}
