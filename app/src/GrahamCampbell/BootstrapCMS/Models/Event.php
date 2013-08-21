<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Event as LaravelEvent;

use Carbon;

class Event extends BaseModel implements Interfaces\ITitleModel, Interfaces\IBodyModel, Interfaces\IDateModel, Interfaces\ILocationModel, Relations\Interfaces\IBelongsToUser {

    use Common\TraitTitleModel, Common\TraitBodyModel, Common\TraitDateModel, Common\TraitLocationModel, Relations\Common\TraitBelongsToUser;

    protected $table = 'events';

    public static $index = array('id', 'title', 'summary', 'date');
    public static $paginate = 10;

    public static $order = 'id';
    public static $sort = 'desc';

    public static $rules = array(
        'title'    => 'required',
        'location' => 'required',
        'date'     => 'required',
        'body'     => 'required',
        'user_id'  => 'required',
    );

    public static $factory = array(
        'id'       => 1,
        'title'    => 'String',
        'location' => 'text',
        'date'     => '2013-08-01 12:34:56',
        'body'     => 'The body of a post.',
        'user_id'  => 1,
    );

    public function getDate() {
        return new Carbon($this->date);
    }

    public static function create(array $input) {
        $return = parent::create($input);
        LaravelEvent::fire('event.created');
        return $return;
    }

    public function update(array $input = array()) {
        $return = parent::update($input);
        LaravelEvent::fire('event.updated');
        return $return;
    }

    public function delete() {
        $return = parent::delete();
        LaravelEvent::fire('event.deleted');
        return $return;
    }
}
