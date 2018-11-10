<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSaleInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sale_info', function(Blueprint $table)
		{
			$table->foreign('unit_type', 'sale_info_ibfk_2')->references('id')->on('unit_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('created_by', 'sale_info_ibfk_4')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('udpated_by', 'sale_info_ibfk_5')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('transaction_id', 'sale_info_ibfk_6')->references('id')->on('client_properties')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sale_info', function(Blueprint $table)
		{
			$table->dropForeign('sale_info_ibfk_2');
			$table->dropForeign('sale_info_ibfk_4');
			$table->dropForeign('sale_info_ibfk_5');
			$table->dropForeign('sale_info_ibfk_6');
		});
	}

}
