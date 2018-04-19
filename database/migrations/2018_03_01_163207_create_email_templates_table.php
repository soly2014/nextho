<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_templates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('template_name', 1024);
			$table->date('activation_date');
			$table->date('expiry_date')->nullable();
			$table->integer('project_id')->index('project_id');
			$table->string('email_title', 5120);
			$table->text('email_body', 65535);
			$table->integer('sent_number')->default(0);
			$table->integer('created_by')->index('created_by');
			$table->integer('updated_by')->nullable()->index('updated_by');
			$table->dateTime('last_updated')->nullable();
			$table->boolean('marked_deleted')->default(0);
			$table->integer('deleted_by')->nullable()->index('deleted_by');
			$table->softDeletes();
			$table->boolean('published')->default(1);
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
		Schema::drop('email_templates');
	}

}
