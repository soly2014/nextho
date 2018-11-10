<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->foreign('created_by', 'projects_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'projects_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('deleted_by', 'projects_ibfk_3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('district', 'projects_ibfk_4')->references('id')->on('project_district')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->dropForeign('projects_ibfk_1');
			$table->dropForeign('projects_ibfk_2');
			$table->dropForeign('projects_ibfk_3');
			$table->dropForeign('projects_ibfk_4');
		});
	}

}
