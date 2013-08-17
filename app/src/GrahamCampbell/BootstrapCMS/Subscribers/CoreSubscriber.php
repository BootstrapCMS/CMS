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

    public function onPageLoad($event) {
        if (Config::get('log.pageload') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Page Loading', $event);
        }
    }

    public function onArtisanStart($event) {
        if (Config::get('log.artisanstart') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Artisan Starting', $event);
        }
    }

    public function onIlluminateQuery($event) {
        if (Config::get('log.illuminatequery') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Query Executed', $event);
        }
    }

    public function onLocaleChanged($event) {
        if (Config::get('log.localechanged') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Locale Changed', $event);
        }
    }
}
