<?php

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
