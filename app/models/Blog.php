<?php

class Blog extends BaseModel {

    protected $table = 'blogs';

    public static $rules = array(
        'title'   => 'required',
        'slug'    => 'required',
        'body'    => 'required',
        'user_id' => 'required'
        );

    public static $factory = array(
        'title'   => 'string',
        'slug'    => 'string',
        'body'    => 'text',
        'user_id' => 'factory|User'
    );

    /**
     * Belongs to user.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo('User');
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
