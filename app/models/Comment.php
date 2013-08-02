<?php

class Comment extends BaseModel implements IBelongsToBlog {

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

    public function blog() {
        return $this->belongsTo('User');
    }

    public function getBlog($columns = array('*')) {
        return $this->blog()->first($columns);
    }

    public function getBlogId() {
        return $this->blog_id;
    }

    public function getBlogSlug() {
        return $this->getBlog(array('slug'))->getSlug();
    }
}
