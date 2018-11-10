<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCampaignMemberStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('campaign_member_status', function(Blueprint $table)
		{
			$table->foreign('created_by', 'campaign_member_status_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'campaign_member_status_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('campaign_member_status', function(Blueprint $table)
		{
			$table->dropForeign('campaign_member_status_ibfk_1');
			$table->dropForeign('campaign_member_status_ibfk_2');
		});
	}

}
