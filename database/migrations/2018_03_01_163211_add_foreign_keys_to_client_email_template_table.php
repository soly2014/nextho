<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClientEmailTemplateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client_email_template', function(Blueprint $table)
		{
			$table->foreign('email_template_id', 'client_email_template_ibfk_2')->references('id')->on('email_templates')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('sent_by', 'client_email_template_ibfk_3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('deleted_by', 'client_email_template_ibfk_4')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('client_id', 'client_email_template_ibfk_5')->references('id')->on('clients')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('client_email_template', function(Blueprint $table)
		{
			$table->dropForeign('client_email_template_ibfk_2');
			$table->dropForeign('client_email_template_ibfk_3');
			$table->dropForeign('client_email_template_ibfk_4');
			$table->dropForeign('client_email_template_ibfk_5');
		});
	}

}
