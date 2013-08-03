<?php

class Post extends BaseModel implements IHasManyComments {

    protected $table = 'posts';

    public $rules = array(
        'title'   => 'required',
        'body'    => 'required',
        'user_id' => 'required',
        );

    public $factory = array(
        'id'      => 1,
        'title'   => 'string',
        'body'    => 'text',
        'user_id' => 1,
    );

    public function getTitle() {
        return $this->title;
    }

    public function getBody() {
        return $this->body;
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
