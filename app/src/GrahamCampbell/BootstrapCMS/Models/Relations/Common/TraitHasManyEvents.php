<?php namespace GrahamCampbell\BootstrapCMS\Models\Relations\Common;

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */

trait TraitHasManyEvents {

    /**
     * Get the event relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function events() {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Event');
    }

    /**
     * Get the event collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEvents() {
        $model = 'GrahamCampbell\BootstrapCMS\Models\Event';

        if (property_exists($model, 'order')) {
            return $this->events()->orderBy($model::$order, $model::$sort)->get($model::$index);
        }

        return $this->events()->get($model::$index);
    }

    /**
     * Get the specified event.
     *
     * @return \GrahamCampbell\BootstrapCMS\Models\Event
     */
    public function findEvent($id, $columns = array('*')) {
        return $this->events()->find($id, $columns);
    }

    /**
     * Delete all events.
     *
     * @return void
     */
    public function deleteEvents() {
        foreach($this->getEvents(array('id')) as $event) {
            $event->delete();
        }
    }
}
