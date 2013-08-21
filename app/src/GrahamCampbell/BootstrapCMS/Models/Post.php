<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Event as LaravelEvent;

class Post extends BaseModel implements Interfaces\ITitleModel, Interfaces\IBodyModel, Relations\Interfaces\IHasManyComments, Relations\Interfaces\IBelongsToUser {

    use Common\TraitTitleModel, Common\TraitBodyModel, Relations\Common\TraitHasManyComments, Relations\Common\TraitBelongsToUser;

    protected $table = 'posts';

    public static $index = array('id', 'title', 'summary');
    public static $paginate = 10;

    public static $order = 'id';
    public static $sort = 'desc';

    public static $rules = array(
        'title'   => 'required',
        'summary' => 'required',
        'body'    => 'required',
        'user_id' => 'required',
    );

    public static $factory = array(
        'id'      => 1,
        'title'   => 'String',
        'summary' => 'Summary of a post.',
        'body'    => 'The body of a post.',
        'user_id' => 1,
    );

    public function getSummary() {
        return $this->summary;
    }

    public static function create(array $input) {
        $return = parent::create($input);
        LaravelEvent::fire('post.created');
        return $return;
    }

    public function update(array $input = array()) {
        $return = parent::update($input);
        LaravelEvent::fire('post.updated');
        return $return;
    }

    public function delete() {
        $this->deleteComments();
        $return = parent::delete();
        LaravelEvent::fire('post.deleted');
        return $return;
    }
}
