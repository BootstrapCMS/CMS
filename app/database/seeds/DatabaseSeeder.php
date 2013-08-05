<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeding.
     */
    public function run() {
        Eloquent::unguard();

        $this->call('SentryGroupSeeder');
        $this->call('SentryUserSeeder');
        $this->call('SentryUserGroupSeeder');

        $this->call('PagesTableSeeder');
        $this->call('PostsTableSeeder');
    }
}
