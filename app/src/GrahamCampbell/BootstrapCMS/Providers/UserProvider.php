<?php namespace GrahamCampbell\BootstrapCMS\Providers;

class UserProvider extends BaseProvider implements Interfaces\IPaginateProvider {

    use Common\TraitPaginateProvider;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\User';

}

