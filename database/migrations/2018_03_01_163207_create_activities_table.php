<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('type');
			$table->integer('status')->index('status');
			$table->date('due_date');
			$table->integer('priority')->default(3);
			$table->string('description', 5120);
			$table->integer('activity_owner')->index('activity_owner');
			$table->dateTime('closed_time')->nullable();
			$table->integer('closed_by')->nullable()->index('closed_by');
			$table->boolean('marked_deleted')->default(0);
			$table->integer('deleted_by')->nullable()->index('deleted_by');
			$table->softDeletes();
			$table->integer('updated_by')->nullable()->index('updated_by');
			$table->integer('activitable_id');
			$table->string('activitable_type', 256);
			$table->integer('created_by')->nullable()->index('created_by');
			$table->timestamps();
			$table->index(['type','status','activity_owner'], 'type');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activities');
	}

}
