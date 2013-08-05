<?php

class PostsTableSeeder extends Seeder {

    /**
     * Run the database seeding.
     */
    public function run() {
        DB::table('posts')->delete();

        $post = array(
            'title'      => 'Hello World',
            'summary'    => 'This is the first blog post.',
            'body'       => 'This is an example blog post.',
            'user_id'    => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
            );

        DB::table('posts')->insert($post);
    }
}
