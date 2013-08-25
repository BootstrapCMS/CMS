<?php namespace GrahamCampbell\BootstrapCMS\Models\Interfaces;

interface INameModel {

    /**
     * Get first_name.
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Get last_name.
     *
     * @return string
     */
    public function getLastName();

    /**
     * Get combined name.
     *
     * @return string
     */
    public function getName();

}
