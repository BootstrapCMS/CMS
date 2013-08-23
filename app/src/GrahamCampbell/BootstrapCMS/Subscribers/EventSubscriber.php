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

    public function onEventCreated($event) {
        //
    }

    public function onEventUpdated($event) {
        //
    }

    public function onEventDeleted($event) {
        //
    }
}
