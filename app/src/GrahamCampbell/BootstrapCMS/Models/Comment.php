<?php namespace GrahamCampbell\BootstrapCMS\Models;

class Comment extends BaseModel implements Interfaces\IBodyModel, Relations\Interfaces\IBelongsToPost, Relations\Interfaces\IBelongsToUser {

    use Common\TraitBodyModel, Relations\Common\TraitBelongsToPost, Relations\Common\TraitBelongsToUser;

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
