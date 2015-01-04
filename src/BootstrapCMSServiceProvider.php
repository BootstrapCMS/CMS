<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS;

use Illuminate\Support\ServiceProvider;

/**
 * This is the bootstrap cms service provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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

        $this->registerCommentController();
        $this->registerPageController();
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
            $navigation = $app['navigation'];
            $credentials = $app['credentials'];
            $pageprovider = $app['pageprovider'];
            $blogging = $app['config']['cms.blogging'];
            $events = $app['config']['cms.events'];
            $cloudflare = class_exists('GrahamCampbell\CloudFlare\CloudFlareServiceProvider');

            return new Subscribers\NavigationSubscriber(
                $navigation,
                $credentials,
                $pageprovider,
                $blogging,
                $events,
                $cloudflare
            );
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
            $throttler = $app['throttle']->get($app['request'], 1, 10);

            return new Controllers\CommentController($throttler);
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
            $path = $app['config']['graham-campbell/core::home'];

            return new Controllers\PageController($path);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'navfactory',
            'commentprovider',
            'eventprovider',
            'fileprovider',
            'folderprovider',
            'pageprovider',
            'postprovider',
        ];
    }
}
