<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipalities extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('municipalities', function(Blueprint $table)
		{
			$table->string('id', 4);
			$table->primary('id');
			$table->timestamps();

			$table->string('name');

			$table->string('county_id');
			$table->foreign('county_id')->references('id')->on('counties');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('municipalities');
	}

}
