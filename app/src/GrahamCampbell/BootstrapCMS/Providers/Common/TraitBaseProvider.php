<?php namespace GrahamCampbell\BootstrapCMS\Providers\Common;

use Config;
use Cache;

trait TraitBaseProvider {

    public function create(array $input) {
        $model = $this->model;
        return $model::create($input);
    }

    public function findById($id, array $columns = array('*')) {
        $model = $this->model;
        return $model::find($id, $columns);
    }
}
