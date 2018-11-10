<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('filename', 1024);
			$table->string('filepath', 2048);
			$table->integer('attached_by')->index('attached_by');
			$table->integer('attachment_owner')->nullable()->index('attachment_owner');
			$table->integer('deleted_by')->nullable()->index('deleted_by_2');
			$table->softDeletes();
			$table->boolean('marked_deleted')->default(0);
			$table->string('size', 16);
			$table->integer('attachable_id');
			$table->string('attachable_type', 256);
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
		Schema::drop('attachments');
	}

}
