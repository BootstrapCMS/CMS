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
        $events->listen('eloquent.creating', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentCreating');
        $events->listen('eloquent.created', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentCreated');
        $events->listen('eloquent.updating', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentUpdating');
        $events->listen('eloquent.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentUpdated');
        $events->listen('eloquent.deleting', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentDeleting');
        $events->listen('eloquent.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentDeleted');
        $events->listen('eloquent.saving', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentSaving');
        $events->listen('eloquent.saved', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentSaved');
        $events->listen('eloquent.restoring', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentRestoring');
        $events->listen('eloquent.restored', 'GrahamCampbell\BootstrapCMS\Subscribers\EloquentSubscriber@onEloquentRestored');
    }

    /**
     * Handle an eloquent.creating event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentCreating($event) {
        if (Config::get('log.eloquenting') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Creating', $event);
        }
    }

    /**
     * Handle an eloquent.created event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentCreated($event) {
        if (Config::get('log.eloquented') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Created', $event);
        }
    }

    /**
     * Handle an eloquent.updating event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentUpdating($event) {
        if (Config::get('log.eloquenting') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Updating', $event);
        }
    }

    /**
     * Handle an eloquent.updated event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentUpdated($event) {
        if (Config::get('log.eloquented') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Updated', $event);
        }
    }

    /**
     * Handle an eloquent.deleting event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentDeleting($event) {
        if (Config::get('log.eloquenting') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Deleting', $event);
        }
    }

    /**
     * Handle an eloquent.deleted event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentDeleted($event) {
        if (Config::get('log.eloquented') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Deleted', $event);
        }
    }

    /**
     * Handle an eloquent.saving event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentSaving($event) {
        if (Config::get('log.eloquenting') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Saving', $event);
        }
    }

    /**
     * Handle an eloquent.saved event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentSaved($event) {
        if (Config::get('log.eloquented') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Saved', $event);
        }
    }

    /**
     * Handle an eloquent.restoring event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentRestoring($event) {
        if (Config::get('log.eloquenting') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Restoring', $event);
        }
    }

    /**
     * Handle an eloquent.restored event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEloquentRestored($event) {
        if (Config::get('log.eloquented') == true) {
            if (!is_array($event)) {
                $event = array($event);
            }
            Log::debug('Eloquent Restored', $event);
        }
    }
}
