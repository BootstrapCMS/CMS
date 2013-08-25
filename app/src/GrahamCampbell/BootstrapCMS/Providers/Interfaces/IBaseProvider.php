<?php namespace GrahamCampbell\BootstrapCMS\Providers\Interfaces;

interface IBaseProvider {

    /**
     * Create a new model.
     *
     * @param  array  $input
     * @return mixed
     */
    public function create(array $input);

    /**
     * Find an existing model.
     *
     * @param  int    $id
     * @param  array  $input
     * @return mixed
     */
    public function find($id, array $columns = array('*'));

    /**
     * Get a list of the models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index();

}
