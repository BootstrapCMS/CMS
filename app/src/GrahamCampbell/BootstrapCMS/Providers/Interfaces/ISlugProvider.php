<?php namespace GrahamCampbell\BootstrapCMS\Providers\Interfaces;

interface ISlugProvider {

    public function find($slug, array $columns = array('*'));

}
