<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

class UserSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('user.created', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserCreated');
        $events->listen('user.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserUpdated');
        $events->listen('user.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserDeleted');
    }

    /**
     * Handle a user.created event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserCreated($event) {
        //
    }

    /**
     * Handle a user.updated event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserUpdated($event) {
        //
    }

    /**
     * Handle a user.deleted event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onUserDeleted($event) {
        //
    }
}
