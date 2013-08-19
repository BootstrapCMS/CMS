<?php namespace GrahamCampbell\BootstrapCMS\Providers\Common;

use Config;
use Cache;

trait TraitBaseProvider {

    public function create(array $input) {
        $model = $this->model;
        return $model::create($input);
    }

    public function find($id, array $columns = array('*')) {
        $model = $this->model;
        return $model::find($id, $columns);
    }

    public function index() {
        $model = $this->model;

        if (property_exists($model, 'order')) {
            return $model::orderBy($model::$order, $model::$sort)->get($model::$index);
        }

        return $model::get($model::$index);
    }
}
