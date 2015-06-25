<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Seeder;

/**
 * This is the database seeder class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('GrahamCampbell\BootstrapCMS\Seeds\GroupsTableSeeder');
        $this->call('GrahamCampbell\BootstrapCMS\Seeds\UsersTableSeeder');
        $this->call('GrahamCampbell\BootstrapCMS\Seeds\UsersGroupsTableSeeder');

        $this->call('GrahamCampbell\BootstrapCMS\Seeds\PagesTableSeeder');
        $this->call('GrahamCampbell\BootstrapCMS\Seeds\PostsTableSeeder');
        $this->call('GrahamCampbell\BootstrapCMS\Seeds\CommentsTableSeeder');
        $this->call('GrahamCampbell\BootstrapCMS\Seeds\EventsTableSeeder');
    }
}
