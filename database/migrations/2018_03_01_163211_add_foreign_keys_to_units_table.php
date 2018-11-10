<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('units', function(Blueprint $table)
		{
			$table->foreign('property_type', 'units_ibfk_1')->references('id')->on('unit_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('finish', 'units_ibfk_2')->references('id')->on('unit_finishs')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('district', 'units_ibfk_3')->references('id')->on('project_district')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('created_by', 'units_ibfk_4')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'units_ibfk_5')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('deleted_by', 'units_ibfk_6')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('district', 'units_ibfk_7')->references('id')->on('project_district')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('units', function(Blueprint $table)
		{
			$table->dropForeign('units_ibfk_1');
			$table->dropForeign('units_ibfk_2');
			$table->dropForeign('units_ibfk_3');
			$table->dropForeign('units_ibfk_4');
			$table->dropForeign('units_ibfk_5');
			$table->dropForeign('units_ibfk_6');
			$table->dropForeign('units_ibfk_7');
		});
	}

}
