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
