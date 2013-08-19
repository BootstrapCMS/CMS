<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

interface IHasManyEvents {

    public function events();

    public function getEvents();

    public function findEvent($id, $columns = array('*'));

    public function deleteEvents();

}
