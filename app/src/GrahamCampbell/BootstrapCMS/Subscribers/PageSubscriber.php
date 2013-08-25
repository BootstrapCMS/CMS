<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

use Navigation;

class PageSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('page.created', 'GrahamCampbell\BootstrapCMS\Subscribers\PageSubscriber@onPageCreated');
        $events->listen('page.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\PageSubscriber@onPageUpdated');
        $events->listen('page.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\PageSubscriber@onPageDeleted');
    }

    /**
     * Handle a page.created event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPageCreated($event) {
        // refresh the navigation cache
        Navigation::refresh();
    }

    /**
     * Handle a page.updated event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPageUpdated($event) {
        // refresh the navigation cache
        Navigation::refresh();
    }

    /**
     * Handle a page.deleted event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPageDeleted($event) {
        // refresh the navigation cache
        Navigation::refresh();
    }
}
