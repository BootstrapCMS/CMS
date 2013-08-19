<?php namespace GrahamCampbell\BootstrapCMS\Providers;

class PostProvider extends BaseProvider implements Interfaces\IPaginateProvider {

    use Common\TraitPaginateProvider;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Post';

}

