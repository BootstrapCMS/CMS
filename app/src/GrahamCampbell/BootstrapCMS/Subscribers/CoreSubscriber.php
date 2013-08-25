<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

use Config;
use Log;

class CoreSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('page.load', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onPageLoad');
        $events->listen('artisan.start', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onArtisanStart');
        $events->listen('illuminate.query', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onIlluminateQuery');
        $events->listen('locale.changed', 'GrahamCampbell\BootstrapCMS\Subscribers\CoreSubscriber@onLocaleChanged');
    }

    /**
     * Handle a page.load event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPageLoad($event) {
        if (Config::get('log.pageload') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Page Loading', $event);
        }
    }

    /**
     * Handle an artisan.start event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onArtisanStart($event) {
        if (Config::get('log.artisanstart') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Artisan Starting', $event);
        }
    }

    /**
     * Handle a illuminate.query event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onIlluminateQuery($event) {
        if (Config::get('log.illuminatequery') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Query Executed', $event);
        }
    }

    /**
     * Handle a locale.changed event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onLocaleChanged($event) {
        if (Config::get('log.localechanged') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Locale Changed', $event);
        }
    }
}
