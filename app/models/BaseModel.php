<?php

abstract class BaseModel extends Eloquent implements IBaseModel {

    use TraitBaseModel;

    protected $guarded = array('_token', '_method', 'id');
}
