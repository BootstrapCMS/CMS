<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Eloquent;

abstract class BaseModel extends Eloquent implements Interfaces\IBaseModel {

    use Common\TraitBaseModel;

    protected $guarded = array('_token', '_method', 'id');

}
