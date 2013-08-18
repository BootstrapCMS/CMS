<?php namespace GrahamCampbell\BootstrapCMS\Providers\Common;

trait TraitSlugProvider {

    public function findBySlug($slug, array $columns = array('*')) {
        $model = $this->model;
        return $model::where('slug', '=', $slug)->first($columns);
    }
}
