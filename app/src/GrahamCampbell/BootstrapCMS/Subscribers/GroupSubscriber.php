<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

class GroupSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('group.created', 'GrahamCampbell\BootstrapCMS\Subscribers\GroupSubscriber@onGroupCreated');
        $events->listen('group.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\GroupSubscriber@onGroupUpdated');
        $events->listen('group.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\GroupSubscriber@onGroupDeleted');
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
