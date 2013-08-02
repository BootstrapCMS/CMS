<?php

abstract class BaseModel extends Eloquent {

    protected $guarded = array('_token', '_method', 'id');

    public function getId() {
        return $this->id;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }
}
