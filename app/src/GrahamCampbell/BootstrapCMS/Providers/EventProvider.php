<?php namespace GrahamCampbell\BootstrapCMS\Providers;

class EventProvider extends BaseProvider implements Interfaces\IPaginateProvider {

    use Common\TraitPaginateProvider;

    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Event';

}
