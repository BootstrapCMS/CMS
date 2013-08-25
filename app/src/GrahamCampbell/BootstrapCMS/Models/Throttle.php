<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Cartalyst\Sentry\Throttling\Eloquent\Throttle as SentryThrottle;

class Throttle extends SentryThrottle implements Interfaces\IBaseModel {

    use Common\TraitBaseModel;

    /**
     * The table the throttles are stored in.
     *
     * @var string
     */
    protected $table = 'throttle';

}
