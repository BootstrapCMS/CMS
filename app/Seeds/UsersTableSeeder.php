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

use Carbon\Carbon;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * This is the users table seeder class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $user = [
            'first_name'   => 'CMS',
            'last_name'    => 'Admin',
            'email'        => 'admin@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => Carbon::now(),
        ];
        Credentials::getUserProvider()->create($user);

        $user = [
            'first_name'   => 'CMS',
            'last_name'    => 'Semi-Admin',
            'email'        => 'semiadmin@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => Carbon::now(),
        ];
        Credentials::getUserProvider()->create($user);

        $user = [
            'first_name'   => 'CMS',
            'last_name'    => 'Moderator',
            'email'        => 'moderator@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => Carbon::now(),
        ];
        Credentials::getUserProvider()->create($user);

        $user = [
            'first_name'   => 'CMS',
            'last_name'    => 'Blogger',
            'email'        => 'blogger@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => Carbon::now(),
        ];
        Credentials::getUserProvider()->create($user);

        $user = [
            'first_name'   => 'CMS',
            'last_name'    => 'Editor',
            'email'        => 'editor@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => Carbon::now(),
        ];
        Credentials::getUserProvider()->create($user);

        $user = [
            'first_name'   => 'CMS',
            'last_name'    => 'User',
            'email'        => 'user@dsmg.co.uk',
            'password'     => 'password',
            'activated'    => 1,
            'activated_at' => Carbon::now(),
        ];
        Credentials::getUserProvider()->create($user);
    }
}
