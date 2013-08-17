<?php namespace GrahamCampbell\BootstrapCMS\Providers\Interfaces;

interface IBaseProvider {

    public function findById($id, array $columns = array('*'));

    public function create(array $input);

}
