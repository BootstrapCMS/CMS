<?php

class SentryUserGroupSeeder extends Seeder {

    /**
     * Run the database seeding.
     */
    public function run() {
        DB::table('users_groups')->delete();

        Sentry::getUserProvider()->findByLogin('admin@dsmg.co.uk')->addGroup(Sentry::getGroupProvider()->findByName('Admins'));
        Sentry::getUserProvider()->findByLogin('moderator@dsmg.co.uk')->addGroup(Sentry::getGroupProvider()->findByName('Moderators'));
        Sentry::getUserProvider()->findByLogin('blogger@dsmg.co.uk')->addGroup(Sentry::getGroupProvider()->findByName('Bloggers'));
        Sentry::getUserProvider()->findByLogin('editor@dsmg.co.uk')->addGroup(Sentry::getGroupProvider()->findByName('Editors'));
        Sentry::getUserProvider()->findByLogin('user@dsmg.co.uk')->addGroup(Sentry::getGroupProvider()->findByName('Users'));
    }
}
