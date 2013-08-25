<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

interface IBelongsToUser {

    /**
     * Get the user relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user();

    /**
     * Get the user model.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\User
     */
    public function getUser($columns = array('*'));

    /**
     * Get the user id.
     *
     * @return int
     */
    public function getUserId();

    /**
     * Get the user email.
     *
     * @return int
     */
    public function getUserEmail();

    /**
     * Get the user name.
     *
     * @return int
     */
    public function getUserName();

}
