<?php namespace GrahamCampbell\BootstrapCMS\Models\Interfaces;

interface IDateModel {

    /**
     * Get the date.
     *
     * @return \Carbon\Carbon
     */
    public function getDate();

    /**
     * Get the formatted date.
     *
     * @return string
     */
    public function getFormattedDate();

}
