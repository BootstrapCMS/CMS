<?php namespace GrahamCampbell\BootstrapCMS\Providers\Interfaces;

interface ISlugProvider {

    public function findBySlug($slug, $columns);

}
