<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 10);
			$table->string('name', 1024);
			$table->string('company', 2048)->nullable();
			$table->string('work_title', 2048)->nullable();
			$table->string('Phone', 256);
			$table->string('mobile', 256);
			$table->string('email', 512);
			$table->boolean('opt_out');
			$table->string('last_name', 512);
			$table->string('fax', 512);
			$table->integer('client_status_id')->index('lead_status');
			$table->integer('client_source_id')->index('lead_source');
			$table->string('secondary_email', 2048);
			$table->string('street', 1024);
			$table->string('state', 1024);
			$table->string('country', 1024);
			$table->string('city', 1024);
			$table->text('zip_code', 65535)->nullable();
			$table->string('description', 5120);
			$table->boolean('marked_deleted');
			$table->softDeletes();
			$table->integer('deleted_by')->nullable();
			$table->boolean('is_customer');
			$table->date('customer_date')->nullable();
			$table->integer('first_property')->nullable()->index('first_property');
			$table->boolean('pending_conversion')->default(0);
			$table->integer('created_by')->index('created_by');
			$table->integer('assigned_to')->index('assigned_to');
			$table->boolean('newly_assigned')->default(0);
			$table->integer('interested_district')->nullable()->index('interested_district');
			$table->integer('interested_type')->nullable()->index('interested_type');
			$table->integer('last_updated_by')->index('last_updated_by');
			$table->dateTime('last_updated')->nullable();
			$table->boolean('show_notes')->default(1);
			$table->boolean('show_all_activities')->default(1);
			$table->boolean('show_all_attachements')->default(1);
			$table->boolean('show_all_emails')->default(1);
			$table->boolean('show_all_campaigns')->default(1);
			$table->string('cat');
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
		Schema::drop('clients');
	}

}
