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
 * This is the users/groups table seeder class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
