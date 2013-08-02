<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User implements IHasManyPages, IHasManyBlogs, IHasManyComments, IHasManyEvents {

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

    public function blogs() {
        return $this->hasMany('Blog');
    }

    public function getBlogs($columns = array('*')) {
        return $this->blogs()->all($columns);
    }

    public function findBlog($id, $columns = array('*')) {
        return $this->blogs()->find($id, $columns);
    }

    public function findBlogBySlug($slug, $columns = array('*')) {
        return $this->blogs()->where('slug', '=', $slug)->first($columns);
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
