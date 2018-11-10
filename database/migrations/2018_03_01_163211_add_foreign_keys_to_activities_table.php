<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activities', function(Blueprint $table)
		{
			$table->foreign('type', 'activities_ibfk_1')->references('id')->on('activity_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('activity_owner', 'activities_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('deleted_by', 'activities_ibfk_3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'activities_ibfk_4')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('status', 'activities_ibfk_5')->references('id')->on('activity_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('created_by', 'activities_ibfk_6')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('closed_by', 'activities_ibfk_7')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activities', function(Blueprint $table)
		{
			$table->dropForeign('activities_ibfk_1');
			$table->dropForeign('activities_ibfk_2');
			$table->dropForeign('activities_ibfk_3');
			$table->dropForeign('activities_ibfk_4');
			$table->dropForeign('activities_ibfk_5');
			$table->dropForeign('activities_ibfk_6');
			$table->dropForeign('activities_ibfk_7');
		});
	}

}
