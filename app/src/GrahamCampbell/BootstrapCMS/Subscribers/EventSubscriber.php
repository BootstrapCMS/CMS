<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

class EventSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('event.created', 'GrahamCampbell\BootstrapCMS\Subscribers\EventSubscriber@onEventCreated');
        $events->listen('event.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\EventSubscriber@onEventUpdated');
        $events->listen('event.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\EventSubscriber@onEventDeleted');
    }

    /**
     * Handle an event.created event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEventCreated($event) {
        //
    }

    /**
     * Handle an event.updated event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEventUpdated($event) {
        //
    }

    /**
     * Handle an event.deleted event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onEventDeleted($event) {
        //
    }
}
