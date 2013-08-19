<?php namespace GrahamCampbell\BootstrapCMS\Providers;

class PageProvider extends BaseProvider implements Interfaces\IPaginateProvider, Interfaces\ISlugProvider {

    use Common\TraitPaginateProvider, Common\TraitSlugProvider;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Page';

}

