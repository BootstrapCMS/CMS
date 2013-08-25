<?php namespace GrahamCampbell\BootstrapCMS\Providers;

class EventProvider extends BaseProvider implements Interfaces\IPaginateProvider {

    use Common\TraitPaginateProvider;

    /**
     * The name of the model to provide.
     *
     * @var string
     */
    protected $model = 'GrahamCampbell\BootstrapCMS\Models\Event';

}
