<?php namespace GrahamCampbell\BootstrapCMS\Models\Interfaces;

interface ISlugModel {

    public function getSlug();

    public function findBySlug($slug, $columns);

}
