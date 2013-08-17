<?php namespace GrahamCampbell\BootstrapCMS\Subscribers;

class CommentSubscriber {

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events) {
        $events->listen('post.created', 'GrahamCampbell\BootstrapCMS\Subscribers\CommentSubscriber@onCommentCreated');
        $events->listen('post.updated', 'GrahamCampbell\BootstrapCMS\Subscribers\CommentSubscriber@onCommentUpdated');
        $events->listen('post.deleted', 'GrahamCampbell\BootstrapCMS\Subscribers\CommentSubscriber@onCommentDeleted');
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
