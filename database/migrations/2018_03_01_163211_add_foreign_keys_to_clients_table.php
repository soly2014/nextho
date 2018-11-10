<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clients', function(Blueprint $table)
		{
			$table->foreign('client_status_id', 'clients_ibfk_1')->references('id')->on('client_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('client_source_id', 'clients_ibfk_2')->references('id')->on('client_source')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('assigned_to', 'clients_ibfk_3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('created_by', 'clients_ibfk_4')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('last_updated_by', 'clients_ibfk_5')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('interested_district', 'clients_ibfk_6')->references('id')->on('project_district')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('interested_type', 'clients_ibfk_7')->references('id')->on('unit_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('first_property', 'clients_ibfk_8')->references('id')->on('client_properties')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clients', function(Blueprint $table)
		{
			$table->dropForeign('clients_ibfk_1');
			$table->dropForeign('clients_ibfk_2');
			$table->dropForeign('clients_ibfk_3');
			$table->dropForeign('clients_ibfk_4');
			$table->dropForeign('clients_ibfk_5');
			$table->dropForeign('clients_ibfk_6');
			$table->dropForeign('clients_ibfk_7');
			$table->dropForeign('clients_ibfk_8');
		});
	}

}
