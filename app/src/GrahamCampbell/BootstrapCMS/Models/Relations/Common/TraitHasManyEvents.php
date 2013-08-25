<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitHasManyEvents {

    /**
     * Get the event relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function events() {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Event');
    }

    /**
     * Get the event collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEvents() {
        $model = 'GrahamCampbell\BootstrapCMS\Models\Event';

        if (property_exists($model, 'order')) {
            return $this->events()->orderBy($model::$order, $model::$sort)->get($model::$index);
        }

        return $this->events()->get($model::$index);
    }

    /**
     * Get the specified event.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Event
     */
    public function findEvent($id, $columns = array('*')) {
        return $this->events()->find($id, $columns);
    }

    /**
     * Delete all events.
     *
     * @return void
     */
    public function deleteEvents() {
        foreach($this->getEvents(array('id')) as $event) {
            $event->delete();
        }
    }
}
