<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

class EventSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('post.created', 'GrahamCampbell\BootstrapCMS\Subscribers\EventSubscriber@onEventCreated');
        $events->listen('post.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\EventSubscriber@onEventUpdated');
        $events->listen('post.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\EventSubscriber@onEventDeleted');
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
