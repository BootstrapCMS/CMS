<?php namespace GrahamCampbell\BootstrapCMS\Providers\Interfaces;

interface IPaginateProvider {

    /**
     * Get a paginated list of the models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function paginate();

    /**
     * Get the paginate links.
     *
     * @return string
     */
    public function links();

}
