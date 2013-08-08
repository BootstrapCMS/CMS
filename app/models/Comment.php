<?php

class Comment extends BaseModel implements IBelongsToPost {

    use TraitBodyModel, TraitBelongsToPost;

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
}
