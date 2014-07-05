<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BallzTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('nickname');
            $table->timestamps();
        });

        Schema::create('games', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->boolean('active');
            $table->timestamps();
        });

        Schema::create('user_games', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('userid')->unsigned();
            $table->integer('gameid')->unsigned();
            $table->integer('cardcount');
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('gameid')->references('id')->on('games');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('users');
        Schema::dropIfExists('games');
        Schema::dropIfExists('user_games');
	}

}
