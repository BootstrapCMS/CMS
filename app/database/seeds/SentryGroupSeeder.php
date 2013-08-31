<?php

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

class SentryGroupSeeder extends Seeder {

    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run() {
        DB::table('groups')->delete();

        // users
        $permissions = array('user' => 1, 'edit' => 0, 'blog' => 0, 'mod' => 0, 'admin' => 0);
        $group = array('name' => 'Users', 'permissions' => $permissions);
        Sentry::getGroupProvider()->create($group);

        // editors
        $permissions = array('user' => 1, 'edit' => 1, 'blog' => 0, 'mod' => 0, 'admin' => 0);
        $group = array('name' => 'Editors', 'permissions' => $permissions);
        Sentry::getGroupProvider()->create($group);

        // bloggers
        $permissions = array('user' => 1, 'edit' => 0, 'blog' => 1, 'mod' => 0, 'admin' => 0);
        $group = array('name' => 'Bloggers', 'permissions' => $permissions);
        Sentry::getGroupProvider()->create($group);

        // moderators
        $permissions = array('user' => 1, 'edit' => 0, 'blog' => 0, 'mod' => 1, 'admin' => 0);
        $group = array('name' => 'Moderators', 'permissions' => $permissions);
        Sentry::getGroupProvider()->create($group);

        // admins
        $permissions = array('user' => 1, 'edit' => 1, 'blog' => 1, 'mod' => 1, 'admin' => 1);
        $group = array('name' => 'Admins', 'permissions' => $permissions);
        Sentry::getGroupProvider()->create($group);
    }
}
