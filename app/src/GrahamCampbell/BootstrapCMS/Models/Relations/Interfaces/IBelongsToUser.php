<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Interfaces;

interface IBelongsToUser {

    public function user();

    public function getUser($columns = array('*'));

    public function getUserId();

    public function getUserEmail();

    public function getUserName();

}
