<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Event;

class Event extends BaseModel implements Interfaces\ITitleModel, Interfaces\IBodyModel, Interfaces\IDateModel, Interfaces\ILocationModel, Relations\Interfaces\IBelongsToUser {

    use Common\TraitTitleModel, Common\TraitBodyModel, Common\TraitDateModel, Common\TraitLocationModel, Relations\Common\TraitBelongsToUser;

    protected $table = 'events';

    public static $index = array('id', 'title', 'summary', 'date');
    public static $paginate = 10;

    public static $order = 'id';
    public static $sort = 'desc';

    public static $rules = array(
        'title'    => 'required',
        'summary'  => 'required',
        'body'     => 'required',
        'date'     => 'required',
        'location' => 'required',
        'user_id'  => 'required',
    );

    public static $factory = array(
        'id'       => 1,
        'title'    => 'String',
        'summary'  => 'Summary of a post.',
        'body'     => 'The body of a post.',
        'date'     => '????',
        'location' => 'text',
        'user_id'  => 1,
    );

    public static function create(array $input) {
        $return = parent::create($input);
        Event::fire('event.created');
        return $return;
    }

    public function update(array $input = array()) {
        $return = parent::update($input);
        Event::fire('event.updated');
        return $return;
    }

    public function delete() {
        $return = parent::delete();
        Event::fire('event.deleted');
        return $return;
    }
}
