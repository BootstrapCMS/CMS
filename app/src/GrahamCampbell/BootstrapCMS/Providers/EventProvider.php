<?php namespace GrahamCampbell\BootstrapCMS\Providers;

use GrahamCampbell\BootstrapCMS\Models\Event;

class EventProvider implements Interfaces\IBaseProvider {

    public function findById($id, array $columns = array('*')) {
        return Event::find($id, $columns);
    }

    public function create(array $input) {
        return Event::create($input);
    }
}
