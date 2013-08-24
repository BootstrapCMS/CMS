<?php

class PagesTableSeeder extends Seeder {

    /**
     * Run the database seeding.
     *
     * @return void
     */
    public function run() {
        DB::table('pages')->delete();

        $home = array(
            'title' => 'Home',
            'slug'  => 'home',
            'body'  => Markdown::string(File::get(app_path('database/seeds/page-home.md'))),
            'show_title' => false,
            'icon'       => 'icon-home',
            'user_id'    => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        );

        DB::table('pages')->insert($home);

        $about = array(
            'title' => 'About',
            'slug'  => 'about',
            'body'  => '<div class="row-fluid"><div class="span8">'.Markdown::string(File::get(app_path('database/seeds/page-about.md'))).'</div></div>',
            'user_id'    => 1,
            'icon'       => 'icon-info-sign',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        );

        DB::table('pages')->insert($about);
    }
}
