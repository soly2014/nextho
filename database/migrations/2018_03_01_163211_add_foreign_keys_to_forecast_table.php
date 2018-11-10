<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToForecastTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('forecast', function(Blueprint $table)
		{
			$table->foreign('created_by', 'forecast_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'forecast_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('deleted_by', 'forecast_ibfk_3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('role_id', 'forecast_ibfk_4')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('forecast', function(Blueprint $table)
		{
			$table->dropForeign('forecast_ibfk_1');
			$table->dropForeign('forecast_ibfk_2');
			$table->dropForeign('forecast_ibfk_3');
			$table->dropForeign('forecast_ibfk_4');
		});
	}

}
