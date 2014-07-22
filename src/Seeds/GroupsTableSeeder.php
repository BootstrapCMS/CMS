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
 */

namespace GrahamCampbell\BootstrapCMS\Seeds;

use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * This is the groups table seeder class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->truncate();

        // users
        $permissions = array('user' => 1, 'edit' => 0, 'blog' => 0, 'mod' => 0, 'admin' => 0);
        $group = array('name' => 'Users', 'permissions' => $permissions);
        Credentials::getGroupProvider()->create($group);

        // editors
        $permissions = array('user' => 1, 'edit' => 1, 'blog' => 0, 'mod' => 0, 'admin' => 0);
        $group = array('name' => 'Editors', 'permissions' => $permissions);
        Credentials::getGroupProvider()->create($group);

        // bloggers
        $permissions = array('user' => 1, 'edit' => 0, 'blog' => 1, 'mod' => 0, 'admin' => 0);
        $group = array('name' => 'Bloggers', 'permissions' => $permissions);
        Credentials::getGroupProvider()->create($group);

        // moderators
        $permissions = array('user' => 1, 'edit' => 0, 'blog' => 0, 'mod' => 1, 'admin' => 0);
        $group = array('name' => 'Moderators', 'permissions' => $permissions);
        Credentials::getGroupProvider()->create($group);

        // admins
        $permissions = array('user' => 1, 'edit' => 1, 'blog' => 1, 'mod' => 1, 'admin' => 1);
        $group = array('name' => 'Admins', 'permissions' => $permissions);
        Credentials::getGroupProvider()->create($group);
    }
}
