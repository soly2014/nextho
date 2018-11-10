<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('client_id')->index('client_id');
			$table->integer('user_id')->index('user_id');
			$table->integer('created_by')->index('created_by');
			$table->integer('updated_by')->nullable()->index('updated_by');
			$table->boolean('marked_deleted')->default(0);
			$table->integer('deleted_by')->nullable()->index('deleted_by');
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
		Schema::drop('clients_users');
	}

}
