<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User {

    protected $table = 'users';

    public static $factory = array();

    /**
     * Has many pages.
     *
     * @return Pages
     */
    public function pages()
    {
        return $this->hasMany('Comment');
    }

    /**
     * Has many events.
     *
     * @return Events
     */
    public function events()
    {
        return $this->hasMany('Comment');
    }

    /**
     * Has many blogs.
     *
     * @return Blogs
     */
    public function blogs()
    {
        return $this->hasMany('Comment');
    }

    /**
     * Has many comments.
     *
     * @return Comments
     */
    public function comments()
    {
        return $this->hasMany('Comment');
    }
}
