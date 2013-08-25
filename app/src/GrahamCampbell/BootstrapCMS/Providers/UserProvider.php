<?php namespace GrahamCampbell\BootstrapCMS\Providers;

class UserProvider extends BaseProvider implements Interfaces\IPaginateProvider {

    use Common\TraitPaginateProvider;

    /**
     * The name of the model to provide.
     *
     * @var string
     */
    protected $model = 'GrahamCampbell\BootstrapCMS\Models\User';

}

