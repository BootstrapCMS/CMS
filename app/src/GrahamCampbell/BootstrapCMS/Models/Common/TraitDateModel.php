<?php namespace GrahamCampbell\BootstrapCMS\Models\Common;

use Carbon;

trait TraitDateModel {

    /**
     * Get the date.
     *
     * @return \Carbon\Carbon
     */
    public function getDate() {
        return new Carbon($this->date);
    }
}
