<?php namespace GrahamCampbell\BootstrapCMS\Providers;

class PageProvider extends BaseProvider implements Interfaces\IPaginateProvider, Interfaces\ISlugProvider {

    use Common\TraitPaginateProvider, Common\TraitSlugProvider;

    /**
     * The name of the model to provide.
     *
     * @var string
     */
    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Page';

}

