<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCampaignClientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('campaign_client', function(Blueprint $table)
		{
			$table->foreign('added_by', 'campaign_client_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('deleted_by', 'campaign_client_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('campaign_id', 'campaign_client_ibfk_3')->references('id')->on('campaigns')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'campaign_client_ibfk_6')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('relation_owner', 'campaign_client_ibfk_7')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('client_id', 'campaign_client_ibfk_8')->references('id')->on('clients')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('campaign_client', function(Blueprint $table)
		{
			$table->dropForeign('campaign_client_ibfk_1');
			$table->dropForeign('campaign_client_ibfk_2');
			$table->dropForeign('campaign_client_ibfk_3');
			$table->dropForeign('campaign_client_ibfk_6');
			$table->dropForeign('campaign_client_ibfk_7');
			$table->dropForeign('campaign_client_ibfk_8');
		});
	}

}
