<?php

abstract class BaseModel extends Eloquent implements IBelongsToUser {

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

    public function user() {
        return $this->belongsTo('User');
    }

    public function getUser($columns = array('*')) {
        return $this->user()->first($columns);
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getUserEmail() {
        return $this->getUser(array('email'))->email;
    }

    public function getUserName() {
        $user = $this->getUser(array('first_name', 'last_name'));
        return $user->first_name.' '.$user->last_name;
    }
}
