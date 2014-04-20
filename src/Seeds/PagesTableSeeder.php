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

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use GrahamCampbell\Markdown\Facades\Markdown;

/**
 * This is the pages table seeder class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->delete();

        $home = array(
            'title' => 'Home',
            'slug'  => 'home',
            'body'  => Markdown::render(File::get(dirname(__FILE__).'/page-home.md')),
            'show_title' => false,
            'icon'       => 'home',
            'user_id'    => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        );

        DB::table('pages')->insert($home);

        $contact = array(
            'title' => 'Contact',
            'slug'  => 'contact',
            'body'  => Markdown::render(File::get(dirname(__FILE__).'/page-contact.md')),
            'user_id'    => 1,
            'icon'       => 'envelope',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        );

        DB::table('pages')->insert($contact);

        $about = array(
            'title' => 'About',
            'slug'  => 'about',
            'body'  => '<div class="row"><div class="col-lg-8">'.Markdown::render(File::get(dirname(__FILE__).'/page-about.md')).'</div></div>',
            'user_id'    => 1,
            'icon'       => 'info-circle',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        );

        DB::table('pages')->insert($about);
    }
}
