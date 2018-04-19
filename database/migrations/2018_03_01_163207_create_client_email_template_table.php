<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientEmailTemplateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_email_template', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('email_subject', 5120);
			$table->integer('client_id')->index('lead_id');
			$table->integer('email_template_id')->index('email_id');
			$table->integer('sent_by')->index('sent_by');
			$table->dateTime('sent_date');
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
		Schema::drop('client_email_template');
	}

}
