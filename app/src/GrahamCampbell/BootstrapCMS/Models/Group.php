<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Cartalyst\Sentry\Groups\Eloquent\Group as SentryGroup;

class Group extends SentryGroup implements Interfaces\IBaseModel {

    use Common\TraitBaseModel;

    protected $table = 'groups';
    
}
