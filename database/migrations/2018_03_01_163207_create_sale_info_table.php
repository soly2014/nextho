<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaleInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sale_info', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('transaction_id')->index('transaction_id');
			$table->integer('unit_type');
			$table->integer('sold_price')->index('unit_finish');
			$table->integer('unit_area');
			$table->integer('created_by')->index('created_by');
			$table->integer('udpated_by')->nullable()->index('udpated_by');
			$table->timestamps();
			$table->index(['unit_type','sold_price','unit_area','created_by','udpated_by'], 'unit_type');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sale_info');
	}

}
