<?php

class Comment extends BaseModel implements IBelongsToPost {

    protected $table = 'comments';

    public $rules = array(
        'body'    => 'required',
        'user_id' => 'required',
        'post_id' => 'required',
    );

    public $factory = array(
        'id'      => 1,
        'body'    => 'This a comment!',
        'user_id' => 1,
        'post_id' => 1,
    );

    public function getBody() {
        return $this->body;
    }

    public function post() {
        return $this->belongsTo('Post');
    }

    public function getPost($columns = array('*')) {
        return $this->post()->first($columns);
    }

    public function getPostId() {
        return $this->post_id;
    }
}
