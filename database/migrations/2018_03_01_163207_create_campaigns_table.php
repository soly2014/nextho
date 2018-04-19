<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaigns', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 1024);
			$table->integer('type')->index('type_2');
			$table->integer('status')->index('status');
			$table->date('start_date');
			$table->date('end_date');
			$table->string('description', 5120);
			$table->integer('source_id')->nullable()->index('source_id');
			$table->dateTime('last_updated')->nullable();
			$table->integer('created_by')->index('created_by');
			$table->integer('updated_by')->nullable()->index('updated_by');
			$table->boolean('marked_deleted')->default(0);
			$table->softDeletes();
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
		Schema::drop('campaigns');
	}

}
