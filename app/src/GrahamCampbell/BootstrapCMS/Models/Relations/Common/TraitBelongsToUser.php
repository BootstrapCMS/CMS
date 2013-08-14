<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitBelongsToUser {

    public function user() {
        return $this->belongsTo('GrahamCampbell\BootstrapCMS\Models\User');
    }

    public function getUser($columns = array('*')) {
        return $this->user()->first($columns);
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getUserEmail() {
        $user = $this->getUser(array('email'));
        return $user->getEmail();
    }

    public function getUserName() {
        $user = $this->getUser(array('first_name', 'last_name'));
        return $user->getName();
    }
}
