<?php

class Comment extends BaseModel implements IBodyModel, IBelongsToPost, IBelongsToUser {

    use TraitBodyModel, TraitBelongsToPost, TraitBelongsToUser;

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
