<?php namespace GrahamCampbell\BootstrapCMS\Providers;

// use Config;

class PageProvider extends BaseProvider implements Interfaces\ISlugProvider {

    use Common\TraitSlugProvider;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Page';

}
