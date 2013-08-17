<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

class GroupSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('post.created', 'GrahamCampbell\BootstrapCMS\Subscribers\GroupSubscriber@onGroupCreated');
        $events->listen('post.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\GroupSubscriber@onGroupUpdated');
        $events->listen('post.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\GroupSubscriber@onGroupDeleted');
    }

    public function onGroupCreated($event) {
        //
    }

    public function onGroupUpdated($event) {
        //
    }

    public function onGroupDeleted($event) {
        //
    }
}
