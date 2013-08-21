<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Event as LaravelEvent;

use Cartalyst\Sentry\Groups\Eloquent\Group as SentryGroup;

class Group extends SentryGroup implements Interfaces\IBaseModel {

    use Common\TraitBaseModel;

    public static $index = array('id', 'name');

    protected $table = 'groups';

    public static function create(array $input) {
        $return = parent::create($input);
        LaravelEvent::fire('group.created');
        return $return;
    }

    public function update(array $input = array()) {
        $return = parent::update($input);
        LaravelEvent::fire('group.updated');
        return $return;
    }

    public function delete() {
        $return = parent::delete();
        LaravelEvent::fire('group.deleted');
        return $return;
    }
}
