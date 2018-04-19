<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_units', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('project_id')->index('project_id');
			$table->integer('unit_type')->index('unit_type');
			$table->integer('unit_finish')->index('unit_finish');
			$table->float('starting_price', 10, 0);
			$table->decimal('unit_area_from', 20, 0);
			$table->decimal('unit_area_to', 20, 0);
			$table->date('delivery_date');
			$table->boolean('available')->default(1);
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
		Schema::drop('project_units');
	}

}
