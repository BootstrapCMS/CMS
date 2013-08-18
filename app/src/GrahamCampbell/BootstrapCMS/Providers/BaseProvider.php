<?php namespace GrahamCampbell\BootstrapCMS\Providers;

use Cache;

abstract class BaseProvider implements \GrahamCampbell\BootstrapCMS\Interfaces\ICacheable, Interfaces\IBaseProvider {

    use Common\TraitBaseProvider;

    // protected $model; // must be set in the extending class

}
