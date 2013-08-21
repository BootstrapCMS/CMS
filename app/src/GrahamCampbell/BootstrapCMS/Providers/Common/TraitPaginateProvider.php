<?php namespace GrahamCampbell\BootstrapCMS\Providers\Common;

use Config;
use Cache;

trait TraitPaginateProvider {

    protected $paginatelinks;

    public function paginate() {
        $model = $this->model;

        if (property_exists($model, 'order')) {
            $values = $model::orderBy($model::$order, $model::$sort)->paginate($model::$paginate, $model::$index);
        } else {
            $values = $model::paginate($model::$paginate, $model::$index);
        }

        if (count($values) != 0) {
            $this->paginatelinks = $values->links();
        } else {
            $this->paginatelinks = '';
        }

        return $values;
    }

    public function links() {
        return $this->paginatelinks;
    }
}
