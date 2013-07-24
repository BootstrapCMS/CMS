<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestsTable extends Migration {

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tests', function(Blueprint $table) {
            $table->increments('id');
            $table->string('author');
			$table->text('body');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('tests');
    }

}
