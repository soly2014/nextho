<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_actions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('client_id')->index('client_id');
			$table->integer('actionable_id');
			$table->string('actionable_type', 1024);
			$table->string('object_type', 1024);
			$table->string('action_type', 1024)->nullable();
			$table->date('date');
			$table->integer('created_by');
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
		Schema::drop('user_actions');
	}

}
