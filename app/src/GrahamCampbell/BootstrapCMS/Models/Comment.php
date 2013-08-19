<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Event;

class Comment extends BaseModel implements Interfaces\IBodyModel, Relations\Interfaces\IBelongsToPost, Relations\Interfaces\IBelongsToUser {

    use Common\TraitBodyModel, Relations\Common\TraitBelongsToPost, Relations\Common\TraitBelongsToUser;

    protected $table = 'comments';

    public static $index = array('id', 'body', 'user_id', 'created_at');

    public static $order = 'id';
    public static $sort = 'desc';

    public static $rules = array(
        'body'    => 'required',
        'user_id' => 'required',
        'post_id' => 'required',
    );

    public static $factory = array(
        'id'      => 1,
        'body'    => 'This a comment!',
        'user_id' => 1,
        'post_id' => 1,
    );

    public static function create(array $input) {
        $return = parent::create($input);
        Event::fire('comment.created');
        return $return;
    }

    public function update(array $input = array()) {
        $return = parent::update($input);
        Event::fire('comment.updated');
        return $return;
    }

    public function delete() {
        $return = parent::delete();
        Event::fire('comment.deleted');
        return $return;
    }
}
