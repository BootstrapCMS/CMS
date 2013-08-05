<?php

class SentryUserSeeder extends Seeder {

    /**
     * Run the database seeding.
     */
    public function run() {
        DB::table('users')->delete();

        $user = array(
            'first_name' => 'CMS',
            'last_name'  => 'Admin',
            'email'      => 'admin@dsmg.co.uk',
            'password'   => 'password',
            'activated'  => 1,
        );
        Sentry::getUserProvider()->create($user);

        $user = array(
            'first_name' => 'CMS',
            'last_name'  => 'Semi-Admin',
            'email'      => 'semiadmin@dsmg.co.uk',
            'password'   => 'password',
            'activated'  => 1,
        );
        Sentry::getUserProvider()->create($user);

        $user = array(
            'first_name' => 'CMS',
            'last_name'  => 'Moderator',
            'email'      => 'moderator@dsmg.co.uk',
            'password'   => 'password',
            'activated'  => 1,
        );
        Sentry::getUserProvider()->create($user);

        $user = array(
            'first_name' => 'CMS',
            'last_name'  => 'Blogger',
            'email'      => 'blogger@dsmg.co.uk',
            'password'   => 'password',
            'activated'  => 1,
        );
        Sentry::getUserProvider()->create($user);

        $user = array(
            'first_name' => 'CMS',
            'last_name'  => 'Editor',
            'email'      => 'editor@dsmg.co.uk',
            'password'   => 'password',
            'activated'  => 1,
        );
        Sentry::getUserProvider()->create($user);

        $user = array(
            'first_name' => 'CMS',
            'last_name'  => 'User',
            'email'      => 'user@dsmg.co.uk',
            'password'   => 'password',
            'activated'  => 1,
        );
        Sentry::getUserProvider()->create($user);
    }
}
