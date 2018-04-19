<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 1024);
			$table->integer('district')->index('district');
			$table->date('delivery_date');
			$table->boolean('available')->default(1);
			$table->string('description', 5120)->nullable();
			$table->string('facilities', 5120)->nullable();
			$table->float('commision_percentag', 10, 0);
			$table->integer('created_by')->index('created_by');
			$table->integer('updated_by')->nullable()->index('updated_by');
			$table->dateTime('last_updated')->nullable();
			$table->boolean('marked_deleted')->default(0);
			$table->integer('deleted_by')->nullable()->index('deleted_by');
			$table->softDeletes();
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
		Schema::drop('projects');
	}

}
