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

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Seeder;

/**
 * This is the database seeder class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('GrahamCampbell\BootstrapCMS\Seeds\GroupsTableSeeder');
        $this->call('GrahamCampbell\BootstrapCMS\Seeds\UsersTableSeeder');
        $this->call('GrahamCampbell\BootstrapCMS\Seeds\UsersGroupsTableSeeder');

        $this->call('GrahamCampbell\BootstrapCMS\Seeds\PagesTableSeeder');
        $this->call('GrahamCampbell\BootstrapCMS\Seeds\PostsTableSeeder');
        $this->call('GrahamCampbell\BootstrapCMS\Seeds\CommentsTableSeeder');
        $this->call('GrahamCampbell\BootstrapCMS\Seeds\EventsTableSeeder');
    }
}
