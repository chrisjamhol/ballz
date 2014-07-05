<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGameActions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('actionflags', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('actions', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->integer('accusing')->unsigned();
            $table->integer('accused')->unsigned();
            $table->integer('actionflag_id')->unsigned();
            $table->integer('amount');
            $table->string('description');
            $table->string('image');
            $table->boolean('approved');
            $table->boolean('accepted');
            $table->timestamps();

            $table->foreign('accusing')->references('id')->on('users');
            $table->foreign('accused')->references('id')->on('users');
            $table->foreign('game_id')->references('id')->on('games');
            $table->foreign('actionflag_id')->references('id')->on('actionflags');
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('actions');
        Schema::dropIfExists('actionflags');
    }

}
