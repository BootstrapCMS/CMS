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
 * This is the users/groups table seeder class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class UsersGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_groups')->truncate();

        $this->matchUser('admin@dsmg.co.uk', 'Admins');
        $this->matchUser('semiadmin@dsmg.co.uk', 'Moderators');
        $this->matchUser('semiadmin@dsmg.co.uk', 'Bloggers');
        $this->matchUser('semiadmin@dsmg.co.uk', 'Editors');
        $this->matchUser('moderator@dsmg.co.uk', 'Moderators');
        $this->matchUser('blogger@dsmg.co.uk', 'Bloggers');
        $this->matchUser('editor@dsmg.co.uk', 'Editors');
        $this->matchUser('user@dsmg.co.uk', 'Users');
    }

    /**
     * Add the user by email to a group.
     *
     * @param string $email
     * @param string $group
     *
     * @return void
     */
    protected function matchUser($email, $group)
    {
        return Credentials::getUserProvider()->findByLogin($email)
            ->addGroup(Credentials::getGroupProvider()->findByName($group));
    }
}
