<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

class UserSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('post.created', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserCreated');
        $events->listen('post.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserUpdated');
        $events->listen('post.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\UserSubscriber@onUserDeleted');
    }

    public function onUserCreated($event) {
        //
    }

    public function onUserUpdated($event) {
        //
    }

    public function onUserDeleted($event) {
        //
    }
}
