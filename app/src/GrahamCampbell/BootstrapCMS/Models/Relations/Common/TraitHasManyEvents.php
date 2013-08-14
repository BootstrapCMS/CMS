<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitHasManyEvents {

    public function events() {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Event');
    }

    public function getEvents($columns = array('*')) {
        return $this->events()->get($columns);
    }

    public function findEvent($id, $columns = array('*')) {
        return $this->events()->find($id, $columns);
    }

    public function deleteEvents() {
        // foreach($this->getEvents(array('id')) as $event) {
        //     $event->delete();
        // }
    }
}
