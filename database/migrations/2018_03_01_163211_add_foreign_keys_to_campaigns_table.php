<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('campaigns', function(Blueprint $table)
		{
			$table->foreign('type', 'campaigns_ibfk_1')->references('id')->on('campaign_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('created_by', 'campaigns_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'campaigns_ibfk_3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('deleted_by', 'campaigns_ibfk_4')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('status', 'campaigns_ibfk_5')->references('id')->on('campaign_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('source_id', 'campaigns_ibfk_6')->references('id')->on('client_source')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('campaigns', function(Blueprint $table)
		{
			$table->dropForeign('campaigns_ibfk_1');
			$table->dropForeign('campaigns_ibfk_2');
			$table->dropForeign('campaigns_ibfk_3');
			$table->dropForeign('campaigns_ibfk_4');
			$table->dropForeign('campaigns_ibfk_5');
			$table->dropForeign('campaigns_ibfk_6');
		});
	}

}
