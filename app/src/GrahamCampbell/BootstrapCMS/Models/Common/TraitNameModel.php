<?php namespace GrahamCampbell\BootstrapCMS\Models\Common;

trait TraitNameModel {

    /**
     * Get first_name.
     *
     * @return string
     */
    public function getFirstName() {
        return $this->first_name;
    }

    /**
     * Get last_name.
     *
     * @return string
     */
    public function getLastName() {
        return $this->last_name;
    }

    /**
     * Get combined name.
     *
     * @return string
     */
    public function getName() {
        return $this->first_name.' '.$this->last_name;
    }
}
