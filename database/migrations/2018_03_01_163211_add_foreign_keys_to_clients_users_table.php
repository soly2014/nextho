<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClientsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clients_users', function(Blueprint $table)
		{
			$table->foreign('user_id', 'clients_users_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('created_by', 'clients_users_ibfk_3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'clients_users_ibfk_4')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('deleted_by', 'clients_users_ibfk_5')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('client_id', 'clients_users_ibfk_6')->references('id')->on('clients')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clients_users', function(Blueprint $table)
		{
			$table->dropForeign('clients_users_ibfk_2');
			$table->dropForeign('clients_users_ibfk_3');
			$table->dropForeign('clients_users_ibfk_4');
			$table->dropForeign('clients_users_ibfk_5');
			$table->dropForeign('clients_users_ibfk_6');
		});
	}

}
