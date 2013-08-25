<?php namespace GrahamCampbell\BootstrapCMS\Models;

use Eloquent;

abstract class BaseModel extends Eloquent implements Interfaces\IBaseModel {

    use Common\TraitBaseModel;

    /**
     * A list of methods protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = array('_token', '_method', 'id');

}
