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

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * This is the events table seeder class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->truncate();

        $date = Carbon::now()->addWeeks(2);

        $date->second = 0;

        $event = [
            'title'      => 'Example Event',
            'date'       => $date,
            'location'   => 'Example Location',
            'body'       => 'This is an example event.',
            'user_id'    => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('events')->insert($event);
    }
}
