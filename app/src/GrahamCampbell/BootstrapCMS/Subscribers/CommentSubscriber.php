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

    public function onCommentCreated($event) {
        //
    }

    public function onCommentUpdated($event) {
        //
    }

    public function onCommentDeleted($event) {
        //
    }
}
