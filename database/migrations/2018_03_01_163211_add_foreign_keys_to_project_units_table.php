<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProjectUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project_units', function(Blueprint $table)
		{
			$table->foreign('project_id', 'project_units_ibfk_1')->references('id')->on('projects')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('unit_type', 'project_units_ibfk_2')->references('id')->on('unit_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('unit_finish', 'project_units_ibfk_3')->references('id')->on('unit_finishs')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('created_by', 'project_units_ibfk_4')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'project_units_ibfk_5')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('deleted_by', 'project_units_ibfk_6')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('project_units', function(Blueprint $table)
		{
			$table->dropForeign('project_units_ibfk_1');
			$table->dropForeign('project_units_ibfk_2');
			$table->dropForeign('project_units_ibfk_3');
			$table->dropForeign('project_units_ibfk_4');
			$table->dropForeign('project_units_ibfk_5');
			$table->dropForeign('project_units_ibfk_6');
		});
	}

}
