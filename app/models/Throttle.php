<?php

class Throttle extends Cartalyst\Sentry\Throttling\Eloquent\Throttle {

    use TraitBaseModel;

    protected $table = 'throttle';

}
