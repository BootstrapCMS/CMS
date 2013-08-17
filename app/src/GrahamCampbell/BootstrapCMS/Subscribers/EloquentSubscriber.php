<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

use Config;
use Log;

class EloquentSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('eloquent.updating', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentUpdating');
        $events->listen('eloquent.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentUpdated');
        $events->listen('eloquent.creating', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentCreating');
        $events->listen('eloquent.created', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentCreated');
    }

    public function onEloquentUpdating($event) {
        if (Config::get('log.eloquentupdating') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Updating', $event);
        }
    }

    public function onEloquentUpdated($event) {
        if (Config::get('log.eloquentupdated') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Updated', $event);
        }
    }

    public function onEloquentCreating($event) {
        if (Config::get('log.eloquentcreating') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Creating', $event);
        }
    }

    public function onEloquentCreated($event) {
        if (Config::get('log.eloquentcreated') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Created', $event);
        }
    }
}
