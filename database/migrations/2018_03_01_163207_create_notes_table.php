<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('note_text', 5120);
			$table->boolean('marked_deleted')->default(0);
			$table->integer('note_owner')->nullable()->index('note_owner');
			$table->integer('deleted_by')->nullable()->index('deleted_by');
			$table->integer('created_by')->index('created_by');
			$table->integer('updated_by')->index('updated_by');
			$table->integer('noteable_id');
			$table->string('noteable_type', 256);
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
		Schema::drop('notes');
	}

}
