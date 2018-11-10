<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('email', 2048);
			$table->string('username', 1024);
			$table->string('password', 60);
			$table->string('password_temp', 60)->nullable();
			$table->boolean('active');
			$table->dateTime('deactivated_at')->nullable();
			$table->integer('role_id')->index('role');
			$table->integer('created_by')->index('created_by');
			$table->integer('updated_by')->nullable()->index('updated_by');
			$table->string('remember_token', 1024)->nullable();
			$table->dateTime('last_login')->nullable();
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
		Schema::drop('users');
	}

}
