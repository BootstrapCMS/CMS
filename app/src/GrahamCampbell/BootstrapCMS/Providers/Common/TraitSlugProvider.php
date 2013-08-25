<?php namespace GrahamCampbell\BootstrapCMS\Providers\Common;

trait TraitSlugProvider {

    /**
     * Find an existing model by slug.
     *
     * @param  string  $slug
     * @param  array   $input
     * @return mixed
     */
    public function find($slug, array $columns = array('*')) {
        $model = $this->model;
        return $model::where('slug', '=', $slug)->first($columns);
    }
}
