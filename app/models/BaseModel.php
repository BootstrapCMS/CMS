<?php

abstract class BaseModel extends Eloquent implements IBelongsToUser {

    use TraitBaseModel, TraitBelongsToUser;

    protected $guarded = array('_token', '_method', 'id');
}
