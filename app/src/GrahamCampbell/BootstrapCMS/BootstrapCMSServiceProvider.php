<?php namespace GrahamCampbell\BootstrapCMS;

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
        return array('commentprovider', 'eventprovider', 'pageprovider', 'postprovider', 'navigation');
    }
}
