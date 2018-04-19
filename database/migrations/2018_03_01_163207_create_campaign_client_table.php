<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCampaignClientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campaign_client', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('campaign_id')->index('campaign_id');
			$table->integer('client_id')->index('client_id');
			$table->string('member_status', 1024);
			$table->integer('added_by')->index('created_by');
			$table->integer('relation_owner')->nullable()->index('relation_owner');
			$table->integer('updated_by')->nullable()->index('updated_by');
			$table->boolean('marked_deleted')->default(0);
			$table->softDeletes();
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
		Schema::drop('campaign_client');
	}

}
