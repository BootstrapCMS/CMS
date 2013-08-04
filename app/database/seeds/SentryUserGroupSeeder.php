<?php

class SentryUserGroupSeeder extends Seeder {

    /**
     * Run the database seeding.
     */
    public function run() {
        DB::table('users_groups')->delete();

        $this->matchUser('admin@dsmg.co.uk', 'Admins');
        $this->matchUser('semiadmin@dsmg.co.uk', 'Moderators');
        $this->matchUser('semiadmin@dsmg.co.uk', 'Bloggers');
        $this->matchUser('semiadmin@dsmg.co.uk', 'Editors');
        $this->matchUser('moderator@dsmg.co.uk', 'Moderators');
        $this->matchUser('blogger@dsmg.co.uk', 'Bloggers');
        $this->matchUser('editor@dsmg.co.uk', 'Editors');
        $this->matchUser('user@dsmg.co.uk', 'Users');
    }

    protected function matchUser($email, $group) {
        return Sentry::getUserProvider()->findByLogin($email)->addGroup(Sentry::getGroupProvider()->findByName($group));
    }
}
