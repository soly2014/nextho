<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEmailTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('email_templates', function(Blueprint $table)
		{
			$table->foreign('created_by', 'email_templates_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'email_templates_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('deleted_by', 'email_templates_ibfk_3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('email_templates', function(Blueprint $table)
		{
			$table->dropForeign('email_templates_ibfk_1');
			$table->dropForeign('email_templates_ibfk_2');
			$table->dropForeign('email_templates_ibfk_3');
		});
	}

}
