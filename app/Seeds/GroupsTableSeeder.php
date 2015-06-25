<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Seeds;

use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * This is the groups table seeder class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
        $permissions = ['user' => 1, 'edit' => 0, 'blog' => 0, 'mod' => 0, 'admin' => 0];
        $group = ['name' => 'Users', 'permissions' => $permissions];
        Credentials::getGroupProvider()->create($group);

        // editors
        $permissions = ['user' => 1, 'edit' => 1, 'blog' => 0, 'mod' => 0, 'admin' => 0];
        $group = ['name' => 'Editors', 'permissions' => $permissions];
        Credentials::getGroupProvider()->create($group);

        // bloggers
        $permissions = ['user' => 1, 'edit' => 0, 'blog' => 1, 'mod' => 0, 'admin' => 0];
        $group = ['name' => 'Bloggers', 'permissions' => $permissions];
        Credentials::getGroupProvider()->create($group);

        // moderators
        $permissions = ['user' => 1, 'edit' => 0, 'blog' => 0, 'mod' => 1, 'admin' => 0];
        $group = ['name' => 'Moderators', 'permissions' => $permissions];
        Credentials::getGroupProvider()->create($group);

        // admins
        $permissions = ['user' => 1, 'edit' => 1, 'blog' => 1, 'mod' => 1, 'admin' => 1];
        $group = ['name' => 'Admins', 'permissions' => $permissions];
        Credentials::getGroupProvider()->create($group);
    }
}
