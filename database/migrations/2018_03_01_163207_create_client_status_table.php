<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_status', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('label', 1024);
			$table->integer('sort_order')->default(1);
			$table->boolean('published')->default(1);
			$table->integer('created_by');
			$table->integer('updated_by')->nullable()->index('updated_by');
			$table->timestamps();
			$table->index(['created_by','updated_by'], 'created_by');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('client_status');
	}

}
