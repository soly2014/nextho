<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('role_name', 2048);
			$table->boolean('active')->default(1);
			$table->integer('created_by')->nullable()->index('created_by');
			$table->boolean('view_leads')->default(0);
			$table->boolean('view_all_leads')->default(0);
			$table->boolean('modify_all_leads')->nullable()->default(0);
			$table->boolean('email_all_leads')->default(0);
			$table->boolean('delete_any_client_attachment')->default(0);
			$table->boolean('restore_any_client_attachment')->default(0);
			$table->boolean('view_any_lead_note')->default(0);
			$table->boolean('view_any_lead_activities')->default(0);
			$table->boolean('view_any_lead_emails')->default(0);
			$table->boolean('view_any_lead_attachments')->default(0);
			$table->boolean('view_any_lead_campaigns')->default(0);
			$table->boolean('initially_assign_leads')->default(0);
			$table->boolean('view_all_customers')->default(0);
			$table->boolean('view_customers')->default(0);
			$table->boolean('modify_all_customers')->default(0);
			$table->boolean('delete_lead_info')->default(0);
			$table->boolean('delete_customer_info')->default(0);
			$table->boolean('delete_any_lead')->default(0);
			$table->boolean('delete_any_customer')->default(0);
			$table->boolean('restore_any_lead')->default(0);
			$table->boolean('restore_any_customer')->default(0);
			$table->boolean('convert_any_customer')->default(0);
			$table->boolean('view_sales')->default(0);
			$table->boolean('view_pending_sales')->default(0);
			$table->boolean('reassign_leads')->default(0);
			$table->boolean('add_projects')->default(0);
			$table->boolean('view_projects')->default(0);
			$table->boolean('delete_projects')->default(0);
			$table->boolean('modify_projects')->default(0);
			$table->boolean('view_project_commission_persentage')->default(0);
			$table->boolean('delete_project_units')->nullable()->default(0);
			$table->boolean('add_project_units')->default(0);
			$table->boolean('modify_project_units')->default(0);
			$table->boolean('view_all_project_emails')->default(0);
			$table->boolean('view_all_project_units')->default(0);
			$table->boolean('view_all_project_notes')->default(0);
			$table->boolean('view_project_notes')->default(0);
			$table->boolean('add_project_notes')->default(0);
			$table->boolean('view_all_projects')->default(0);
			$table->boolean('view_project_ui_notes')->default(0);
			$table->boolean('view_project_ui_emails')->default(0);
			$table->boolean('view_project_ui_units')->default(0);
			$table->boolean('view_all_units')->default(0);
			$table->boolean('view_units')->default(0);
			$table->boolean('add_units')->default(0);
			$table->boolean('modify_units')->default(0);
			$table->boolean('delete_units')->default(0);
			$table->boolean('view_all_unit_notes')->default(0);
			$table->boolean('add_unit_note')->default(0);
			$table->boolean('view_unit_notes')->default(0);
			$table->boolean('view_campaigns')->default(0);
			$table->boolean('view_all_campaigns')->default(0);
			$table->boolean('add_campaigns')->default(0);
			$table->boolean('modify_campaigns')->default(0);
			$table->boolean('delete_campaigns')->default(0);
			$table->boolean('add_campaign_note')->default(0);
			$table->boolean('add_campaign_activity')->default(0);
			$table->boolean('add_campaign_attachment')->default(0);
			$table->boolean('view_any_campaign_notes')->default(0);
			$table->boolean('view_any_campaign_activities')->default(0);
			$table->boolean('view_any_campaign_attachments')->default(0);
			$table->boolean('view_any_campaign_leads')->default(0);
			$table->boolean('view_campaign_notes')->default(0);
			$table->boolean('view_campaign_activities')->default(0);
			$table->boolean('view_campaign_attachments')->default(0);
			$table->boolean('delete_any_campaign_attachment')->default(0);
			$table->boolean('restore_any_campaign_attachment')->default(0);
			$table->boolean('view_campaign_leads')->default(0);
			$table->boolean('view_campaign_ui_notes')->default(0);
			$table->boolean('view_campaign_ui_activities')->default(0);
			$table->boolean('view_campaign_ui_attachments')->default(0);
			$table->boolean('view_campaign_ui_leads')->default(0);
			$table->boolean('view_email_templates')->default(0);
			$table->boolean('add_email_templates')->default(0);
			$table->boolean('modify_email_templates')->default(0);
			$table->boolean('add_email_attachment')->default(0);
			$table->boolean('add_email_note')->default(0);
			$table->boolean('delete_email_templates')->default(0);
			$table->boolean('view_all_email_templates')->default(0);
			$table->boolean('send_all_email_templates')->default(0);
			$table->boolean('view_reports')->default(0);
			$table->boolean('view_forecast')->default(0);
			$table->boolean('add_forecast')->default(0);
			$table->boolean('approve_sales')->default(0);
			$table->boolean('manage_users')->default(0);
			$table->boolean('view_users')->default(0);
			$table->boolean('add_users')->default(0);
			$table->boolean('delete_users')->default(0);
			$table->boolean('deactiveate_users')->default(0);
			$table->boolean('manage_roles')->default(0);
			$table->boolean('add_roles')->default(0);
			$table->boolean('modify_roles')->default(0);
			$table->boolean('deactivate_roles')->default(0);
			$table->boolean('modify_any_note')->nullable()->default(0);
			$table->boolean('delete_any_note')->nullable()->default(0);
			$table->boolean('restore_any_note')->nullable()->default(0);
			$table->boolean('close_any_activity')->default(0);
			$table->boolean('view_any_activity')->default(0);
			$table->boolean('modify_any_activity')->default(0);
			$table->boolean('delete_any_activity')->default(0);
			$table->boolean('restore_any_activities')->default(0);
			$table->boolean('download_any_attachment')->default(0);
			$table->boolean('download_assigned_attachment')->default(0);
			$table->boolean('delete_any_attachment')->default(0);
			$table->boolean('restore_any_attachment')->default(0);
			$table->boolean('delete_any_campaign_client_relation')->default(0);
			$table->boolean('restore_any_campaign_client_relation')->default(0);
			$table->boolean('add_lead_note')->default(0);
			$table->boolean('add_lead_attachment')->default(0);
			$table->boolean('add_lead_activity')->default(0);
			$table->boolean('add_lead_campaign')->default(0);
			$table->integer('add_customer_note')->default(0);
			$table->boolean('add_customer_attachment')->default(0);
			$table->boolean('add_customer_activity')->default(0);
			$table->boolean('add_customer_campaign')->default(0);
			$table->boolean('view_any_customer_note')->default(0);
			$table->boolean('view_any_customer_activities')->default(0);
			$table->boolean('view_any_customer_emails')->default(0);
			$table->boolean('view_any_customer_attachments')->default(0);
			$table->boolean('view_any_customer_campaigns')->default(0);
			$table->boolean('view_parameters')->default(0);
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
		Schema::drop('roles');
	}

}
