<?php

class Comment extends BaseModel implements IBelongsToPost {

    protected $table = 'comments';

    public static $rules = array(
        'title'   => 'required',
        'body'    => 'required',
        'user_id' => 'required',
        'post_id' => 'required',
    );

    public static $factory = array(
        'title'   => 'string',
        'body'    => 'text',
        'user_id' => 1,
        'post_id' => 1,
    );

    public function post() {
        return $this->belongsTo('User');
    }

    public function getPost($columns = array('*')) {
        return $this->post()->first($columns);
    }

    public function getPostId() {
        return $this->post_id;
    }
}
