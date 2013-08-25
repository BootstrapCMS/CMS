<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

interface IHasManyEvents {

    /**
     * Get the event relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function events();

    /**
     * Get the event collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEvents();

    /**
     * Get the specified event.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Event
     */
    public function findEvent($id, $columns = array('*'));

    /**
     * Delete all events.
     *
     * @return void
     */
    public function deleteEvents();

}
