<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User implements IHasManyPages, IHasManyPosts, IHasManyComments, IHasManyEvents {

    protected $table = 'users';

    public $rules = array();

    public $factory = array();

    public function pages() {
        return $this->hasMany('Page');
    }

    public function getPages($columns = array('*')) {
        return $this->pages()->all($columns);
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
        return $this->posts()->all($columns);
    }

    public function findPost($id, $columns = array('*')) {
        return $this->posts()->find($id, $columns);
    }

    public function events() {
        return $this->hasMany('Event');
    }

    public function getEvents($columns = array('*')) {
        return $this->events()->all($columns);
    }

    public function findEvent($id, $columns = array('*')) {
        return $this->events()->find($id, $columns);
    }

    public function comments() {
        return $this->hasMany('Comment');
    }

    public function getComments($columns = array('*')) {
        return $this->comments()->all($columns);
    }

    public function findComment($id, $columns = array('*')) {
        return $this->comments()->find($id, $columns);
    }
}
