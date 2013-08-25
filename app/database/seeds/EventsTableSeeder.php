<?php

class EventsTableSeeder extends Seeder {

    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run() {
        DB::table('events')->delete();

        $date = Carbon::now();

        $event = array(
            'title'      => 'Example Event',
            'date'       => $date->addWeeks(2),
            'location'   => 'Example Location',
            'body'       => 'This is an example event.',
            'user_id'    => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        );

        DB::table('events')->insert($event);
    }
}
