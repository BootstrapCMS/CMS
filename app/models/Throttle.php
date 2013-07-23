<?php

class Throttle extends Cartalyst\Sentry\Throttling\Eloquent\Throttle {

    protected $table = 'throttle';

    public static $factory = array();

}
