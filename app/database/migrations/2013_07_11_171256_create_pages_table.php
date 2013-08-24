<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pages', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->text('body');
            $table->boolean('show_title')->default(true);
            $table->boolean('show_nav')->default(true);
            $table->string('icon')->default('');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('pages');
    }
}
