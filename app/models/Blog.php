<?php

class Blog extends BaseModel IHasManyComments {

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
