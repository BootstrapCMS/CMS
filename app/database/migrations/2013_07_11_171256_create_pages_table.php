<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('pages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('body');
            $table->boolean('show_title')->default(true);
            $table->boolean('show_nav')->default(true);
            $table->string('icon')->default('');
            $table->integer('author_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::drop('pages');
    }
}
