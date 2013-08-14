<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Cartalyst\Sentry\Throttling\Eloquent\Throttle as SentryThrottle;

class Throttle extends SentryThrottle implements Interfaces\IBaseModel {

    use Common\TraitBaseModel;

    protected $table = 'throttle';

}
