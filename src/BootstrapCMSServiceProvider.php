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

        $this->setupBlade();
    }

    /**
     * Setup the blade compiler class.
     *
     * @return void
     */
    protected function setupBlade()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $this->app['view']->share('__navtype', 'default');

        $blade->extend(function ($value, $compiler) {
            $pattern = $compiler->createMatcher('navtype');
            $replace = '$1<?php $__navtype = $2; ?>';
            return preg_replace($pattern, $replace, $value);
        });

        $blade->extend(function ($value, $compiler) {
            $pattern = $compiler->createPlainMatcher('navigation');
            $replace = '$1<?php echo \GrahamCampbell\BootstrapCMS\Facades\NavigationFactory::make($__navtype); ?>$2';
            return preg_replace($pattern, $replace, $value);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerNavigationFactory();

        $this->registerCommentProvider();
        $this->registerEventProvider();
        $this->registerPageProvider();
        $this->registerPostProvider();

        $this->registerCommandSubscriber();
        $this->registerCoreSubscriber();
        $this->registerNavigationSubscriber();

        $this->registerCachingController();
        $this->registerCommentController();
        $this->registerEventController();
        $this->registerHomeController();
        $this->registerPageController();
        $this->registerPostController();
    }

    /**
     * Register the navigation factory class.
     *
     * @return void
     */
    protected function registerNavigationFactory()
    {
        $this->app->bindShared('navfactory', function ($app) {
            $credentials = $app['credentials'];
            $navigation = $app['navigation'];
            $name = $app['config']['platform.name'];
            $property = $app['config']['cms.nav'];
            $inverse = $app['config']['theme.inverse'];

            return new Navigation\Factory($credentials, $navigation, $name, $property, $inverse);
        });

        $this->app->alias('navfactory', 'GrahamCampbell\BootstrapCMS\Navigation\Factory');
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

            $validator = $app['validator'];

            return new Providers\CommentProvider($comment, $validator);
        });

        $this->app->alias('commentprovider', 'GrahamCampbell\BootstrapCMS\Providers\CommentProvider');
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

            $validator = $app['validator'];

            return new Providers\EventProvider($event, $validator);
        });

        $this->app->alias('eventprovider', 'GrahamCampbell\BootstrapCMS\Providers\EventProvider');
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

            $validator = $app['validator'];

            return new Providers\PageProvider($page, $validator);
        });

        $this->app->alias('pageprovider', 'GrahamCampbell\BootstrapCMS\Providers\PageProvider');
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

            $validator = $app['validator'];

            return new Providers\PostProvider($post, $validator);
        });

        $this->app->alias('postprovider', 'GrahamCampbell\BootstrapCMS\Providers\PostProvider');
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
        $this->app->bindShared('GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber', function ($app) {
            $config = $app['config'];
            $navigation = $app['navigation'];
            $credentials = $app['credentials'];
            $pageprovider = $app['pageprovider'];

            return new Subscribers\NavigationSubscriber($config, $navigation, $credentials, $pageprovider);
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
            $view = $app['view'];

            return new Controllers\CachingController($credentials, $view);
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
            $view = $app['view'];
            $session = $app['session'];
            $binput = $app['binput'];
            $commentprovider = $app['commentprovider'];
            $postprovider = $app['postprovider'];
            $throttler = $app['throttle']->get($app['request'], 1, 10);

            return new Controllers\CommentController(
                $credentials,
                $view,
                $session,
                $binput,
                $commentprovider,
                $postprovider,
                $throttler
            );
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
            $view = $app['view'];
            $binput = $app['binput'];
            $eventprovider = $app['eventprovider'];

            return new Controllers\EventController($credentials, $view, $binput, $eventprovider);
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
            $view = $app['view'];
            $mailer = $app['mailer'];
            $email = $app['config']['workbench.email'];
            $subject = $app['config']['platform.name'].' - Welcome';

            return new Controllers\HomeController($credentials, $view, $mailer, $email, $subject);
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
            $view = $app['view'];
            $session = $app['session'];
            $binput = $app['binput'];
            $pageprovider = $app['pageprovider'];

            return new Controllers\PageController($credentials, $view, $session, $binput, $pageprovider);
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
            $view = $app['view'];
            $binput = $app['binput'];
            $postprovider = $app['postprovider'];

            return new Controllers\PostController($credentials, $view, $binput, $postprovider);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return array(
            'navfactory',
            'commentprovider',
            'eventprovider',
            'fileprovider',
            'folderprovider',
            'pageprovider',
            'postprovider'
        );
    }
}
