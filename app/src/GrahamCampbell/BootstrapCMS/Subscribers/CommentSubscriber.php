<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

class CommentSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('comment.created', 'GrahamCampbell\BootstrapCMS\Subscribers\CommentSubscriber@onCommentCreated');
        $events->listen('comment.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\CommentSubscriber@onCommentUpdated');
        $events->listen('comment.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\CommentSubscriber@onCommentDeleted');
    }

    /**
     * Handle a comment.created event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onCommentCreated($event) {
        //
    }

    /**
     * Handle a comment.updated event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onCommentUpdated($event) {
        //
    }

    /**
     * Handle a comment.deleted event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onCommentDeleted($event) {
        //
    }
}
