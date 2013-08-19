<?php namespace GrahamCampbell\BootstrapCMS\Providers\Interfaces;

interface IBaseProvider {

    public function find($id, array $columns = array('*'));

    public function create(array $input);

    public function index();

}
