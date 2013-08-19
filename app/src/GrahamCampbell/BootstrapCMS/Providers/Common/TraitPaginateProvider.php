<?php namespace GrahamCampbell\BootstrapCMS\Providers\Common;

use Config;
use Cache;

trait TraitPaginateProvider {

    public function paginate() {
        $model = $this->model;

        if (property_exists($model, 'order')) {
            return $model::orderBy($model::$order, $model::$sort)->paginate($model::$paginate, $model::$index);
        }

        return $model::paginate($model::$paginate, $model::$index);
    }
}
