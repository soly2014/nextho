<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForecastTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forecast', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('month');
			$table->integer('year');
			$table->float('amount', 10, 0);
			$table->integer('role_id')->index('role_id');
			$table->integer('created_by')->index('created_by');
			$table->integer('updated_by')->nullable()->index('updated_by');
			$table->boolean('marked_deleted')->default(0);
			$table->integer('deleted_by')->nullable()->index('deleted_by');
			$table->softDeletes();
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
		Schema::drop('forecast');
	}

}
