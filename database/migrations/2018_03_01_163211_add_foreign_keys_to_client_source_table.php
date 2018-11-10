<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClientSourceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_source', function(Blueprint $table)
		{
			$table->foreign('created_by', 'client_source_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'client_source_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('client_source', function(Blueprint $table)
		{
			$table->dropForeign('client_source_ibfk_1');
			$table->dropForeign('client_source_ibfk_2');
		});
	}

}
