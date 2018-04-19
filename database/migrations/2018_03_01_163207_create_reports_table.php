<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reports', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('report_name', 1024);
			$table->integer('number_generated')->default(0);
			$table->dateTime('last_generated_at')->nullable();
			$table->integer('user_id')->index('user_id');
			$table->boolean('active')->default(1);
			$table->string('route', 1024);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reports');
	}

}
