<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User implements IHasManyPages, IHasManyPosts, IHasManyComments, IHasManyEvents {

    protected $table = 'users';

    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getName() {
        return $this->first_name.' '.$this->last_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function pages() {
        return $this->hasMany('Page');
    }

    public function getPages($columns = array('*')) {
        return $this->pages()->get($columns);
    }

    public function findPage($id, $columns = array('*')) {
        return $this->pages()->find($id, $columns);
    }

    public function findPageBySlug($slug, $columns = array('*')) {
        return $this->pages()->where('slug', '=', $slug)->first($columns);
    }

    public function posts() {
        return $this->hasMany('Post');
    }

    public function getPosts($columns = array('*')) {
        return $this->posts()->get($columns);
    }

    public function findPost($id, $columns = array('*')) {
        return $this->posts()->find($id, $columns);
    }

    public function events() {
        return $this->hasMany('Event');
    }

    public function getEvents($columns = array('*')) {
        return $this->events()->get($columns);
    }

    public function findEvent($id, $columns = array('*')) {
        return $this->events()->find($id, $columns);
    }

    public function comments() {
        return $this->hasMany('Comment');
    }

    public function getComments($columns = array('*')) {
        return $this->comments()->get($columns);
    }

    public function getCommentsReversed($columns = array('*')) {
        return $this->comments()->orderBy('id', 'desc')->get($columns);
    }

    public function findComment($id, $columns = array('*')) {
        return $this->comments()->find($id, $columns);
    }

    public function delete() {
        foreach($this->getPages(array('id')) as $page) {
            $page->delete();
        }

        foreach($this->getPosts(array('id')) as $post) {
            $post->delete();
        }

        // foreach($this->getEvents(array('id')) as $event) {
        //     $event->delete();
        // }

        foreach($this->getComments(array('id')) as $comment) {
            $comment->delete();
        }

        return parent::delete();
    }
}
