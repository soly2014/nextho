<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientPropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_properties', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('project_id')->nullable();
			$table->integer('unit_id')->nullable();
			$table->float('price', 10, 0)->nullable();
			$table->string('propertable_type', 1024);
			$table->integer('propertable_id');
			$table->integer('created_by');
			$table->integer('updated_by')->nullable();
			$table->boolean('marked_deleted')->default(0);
			$table->integer('deleted_by')->nullable();
			$table->boolean('approved')->default(0);
			$table->boolean('pending')->default(1);
			$table->integer('status_updated_by')->nullable();
			$table->dateTime('status_updated_at')->nullable();
			$table->integer('month');
			$table->integer('year');
			$table->string('comment', 5120)->nullable();
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
		Schema::drop('client_properties');
	}

}
