<?php

class Comment extends BaseModel {

    protected $table = 'comments';

    public static $rules = array(
        'title'   => 'required',
        'body'    => 'required',
        'user_id' => 'required',
        'blog_id' => 'required'
        );

    public static $factory = array(
        'title'   => 'string',
        'body'    => 'text',
        'user_id' => 'factory|User',
        'blog_id' => 'factory|Blog'
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
     * Belongs to blog.
     *
     * @return Blog
     */
    public function blog()
    {
        return $this->belongsTo('Blog');
    }
}
