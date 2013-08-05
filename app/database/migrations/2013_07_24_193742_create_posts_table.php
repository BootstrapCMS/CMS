<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('summary');
            $table->text('body');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::drop('posts');
    }
}
