<?php

class Group extends Cartalyst\Sentry\Groups\Eloquent\Group implements IBaseModel {

    use TraitBaseModel;

    protected $table = 'groups';
    
}
