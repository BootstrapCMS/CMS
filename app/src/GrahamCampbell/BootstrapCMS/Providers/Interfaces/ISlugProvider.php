<?php namespace GrahamCampbell\BootstrapCMS\Providers\Interfaces;

interface ISlugProvider {

    /**
     * Find an existing model by slug.
     *
     * @param  string  $slug
     * @param  array   $input
     * @return mixed
     */
    public function find($slug, array $columns = array('*'));

}
