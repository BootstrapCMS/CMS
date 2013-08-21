<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitHasManyEvents {

    public function events() {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Event');
    }

    public function getEvents() {
        $model = 'GrahamCampbell\BootstrapCMS\Models\Event';

        if (property_exists($model, 'order')) {
            return $this->events()->orderBy($model::$order, $model::$sort)->get($model::$index);
        }

        return $this->events()->get($model::$index);
    }

    public function findEvent($id, $columns = array('*')) {
        return $this->events()->find($id, $columns);
    }

    public function deleteEvents() {
        foreach($this->getEvents(array('id')) as $event) {
            $event->delete();
        }
    }
}
