<?php namespace GrahamCampbell\BootstrapCMS\Models\Common;

use Carbon;

trait TraitDateModel {

    /**
     * Get the date.
     *
     * @return \Carbon\Carbon
     */
    public function getDate() {
        $date = new Carbon($this->date);
        return $date;
    }

    /**
     * Get the formatted date.
     *
     * @return string
     */
    public function getFormattedDate() {
        $date = new Carbon($this->date);
        return $date->format('l jS F Y \\- H:i:s');
    }
}
