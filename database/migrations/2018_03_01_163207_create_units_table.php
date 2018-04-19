<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('units', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('property_id', 15)->unique('property_id');
			$table->integer('property_type')->index('property_type');
			$table->string('property_status', 1024);
			$table->float('price', 10, 0)->nullable();
			$table->float('area', 10, 0)->nullable();
			$table->integer('bathrooms')->nullable();
			$table->integer('bedrooms')->nullable();
			$table->integer('finish')->nullable()->index('finish');
			$table->integer('floor')->nullable();
			$table->float('garden_area', 10, 0)->nullable();
			$table->integer('number_of_apartments_Floor')->nullable();
			$table->integer('number_of_elevators')->nullable();
			$table->integer('number_of_floors')->nullable();
			$table->float('percentage_of_built_area', 10, 0)->nullable();
			$table->boolean('elevator')->nullable();
			$table->boolean('garage')->nullable();
			$table->boolean('garden')->nullable();
			$table->boolean('roof')->nullable();
			$table->boolean('roof_terrace')->nullable();
			$table->decimal('total_built_area', 10, 0)->nullable();
			$table->decimal('total_land_area', 10, 0)->nullable();
			$table->string('address', 2048);
			$table->integer('district')->index('District');
			$table->float('commision_percentage', 10, 0);
			$table->string('description', 5120)->nullable();
			$table->boolean('sold')->default(0);
			$table->boolean('on_hold')->default(0);
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
		Schema::drop('units');
	}

}
