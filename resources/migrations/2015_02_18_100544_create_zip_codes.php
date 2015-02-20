<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZipCodes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zip_codes', function(Blueprint $table)
		{
			$table->string('id', 4);
			$table->primary('id');
			$table->timestamps();

			$table->string('name');
			$table->string('municipality_id');
			$table->foreign('municipality_id')->references('id')->on('municipalities');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zip_codes');
	}

}
