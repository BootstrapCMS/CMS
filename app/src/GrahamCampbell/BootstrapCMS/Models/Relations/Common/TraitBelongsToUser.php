<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

trait TraitBelongsToUser {

    /**
     * Get the user relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('GrahamCampbell\BootstrapCMS\Models\User');
    }

    /**
     * Get the user model.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\User
     */
    public function getUser($columns = array('*')) {
        return $this->user()->first($columns);
    }

    /**
     * Get the user id.
     *
     * @return int
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * Get the user email.
     *
     * @return int
     */
    public function getUserEmail() {
        $user = $this->getUser(array('email'));
        return $user->getEmail();
    }

    /**
     * Get the user name.
     *
     * @return int
     */
    public function getUserName() {
        $user = $this->getUser(array('first_name', 'last_name'));
        return $user->getName();
    }
}
