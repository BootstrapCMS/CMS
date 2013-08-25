<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

class PostSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('post.created', 'GrahamCampbell\BootstrapCMS\Subscribers\PostSubscriber@onPostCreated');
        $events->listen('post.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\PostSubscriber@onPostUpdated');
        $events->listen('post.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\PostSubscriber@onPostDeleted');
    }

    /**
     * Handle a post.created event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPostCreated($event) {
        //
    }

    /**
     * Handle a post.updated event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPostUpdated($event) {
        //
    }

    /**
     * Handle a post.deleted event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onPostDeleted($event) {
        //
    }
}
