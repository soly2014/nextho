<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToActivityTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activity_types', function(Blueprint $table)
		{
			$table->foreign('created_by', 'activity_types_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'activity_types_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activity_types', function(Blueprint $table)
		{
			$table->dropForeign('activity_types_ibfk_1');
			$table->dropForeign('activity_types_ibfk_2');
		});
	}

}
