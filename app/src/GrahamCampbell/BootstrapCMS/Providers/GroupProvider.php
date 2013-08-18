<?php namespace GrahamCampbell\BootstrapCMS\Providers;

class GroupProvider extends BaseProvider {

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Group';

    // TODO: caching logic
    public function index() {
        $model = $this->model;
        return $model::get(array('id', 'name'));
    }
}
