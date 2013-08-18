<?php namespace GrahamCampbell\BootstrapCMS\Providers;

class PostProvider extends BaseProvider {

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Post';

    // TODO: caching logic
    public function index() {
        $model = $this->model;
        return $model::orderBy('id', 'desc')->get(array('id', 'title', 'summary', 'body'));
    }
}
