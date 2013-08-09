<?php

class CommentsTableSeeder extends Seeder {

    /**
     * Run the database seeding.
     */
    public function run() {
        DB::table('comments')->delete();

        $comment = array(
            'body'       => 'This is an example comment.',
            'user_id'    => 1,
            'post_id'    => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        );

        DB::table('comments')->insert($comment);
    }
}
