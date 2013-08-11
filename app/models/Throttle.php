<?php

class Throttle extends Cartalyst\Sentry\Throttling\Eloquent\Throttle implements IBaseModel {

    use TraitBaseModel;

    protected $table = 'throttle';

}
