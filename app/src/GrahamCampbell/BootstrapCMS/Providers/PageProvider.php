<?php namespace GrahamCampbell\BootstrapCMS\Providers;

class PageProvider extends BaseProvider implements Interfaces\ISlugProvider {

    use Common\TraitSlugProvider;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Page';

}
