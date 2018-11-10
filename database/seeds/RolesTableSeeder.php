<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_name' => 'Admin',
                'active' => 1,
                'created_by' => 5,
                'view_leads' => 1,
                'view_all_leads' => 1,
                'modify_all_leads' => 1,
                'email_all_leads' => 1,
                'delete_any_client_attachment' => 1,
                'restore_any_client_attachment' => 1,
                'view_any_lead_note' => 1,
                'view_any_lead_activities' => 1,
                'view_any_lead_emails' => 1,
                'view_any_lead_attachments' => 1,
                'view_any_lead_campaigns' => 1,
                'initially_assign_leads' => 1,
                'view_all_customers' => 1,
                'view_customers' => 1,
                'modify_all_customers' => 1,
                'delete_lead_info' => 1,
                'delete_customer_info' => 1,
                'delete_any_lead' => 1,
                'delete_any_customer' => 1,
                'restore_any_lead' => 0,
                'restore_any_customer' => 0,
                'convert_any_customer' => 1,
                'view_sales' => 1,
                'view_pending_sales' => 1,
                'reassign_leads' => 1,
                'add_projects' => 1,
                'view_projects' => 1,
                'delete_projects' => 1,
                'modify_projects' => 1,
                'view_project_commission_persentage' => 1,
                'delete_project_units' => 1,
                'add_project_units' => 1,
                'modify_project_units' => 1,
                'view_all_project_emails' => 1,
                'view_all_project_units' => 1,
                'view_all_project_notes' => 1,
                'view_project_notes' => 1,
                'add_project_notes' => 1,
                'view_all_projects' => 1,
                'view_project_ui_notes' => 1,
                'view_project_ui_emails' => 1,
                'view_project_ui_units' => 1,
                'view_all_units' => 1,
                'view_units' => 1,
                'add_units' => 1,
                'modify_units' => 1,
                'delete_units' => 1,
                'view_all_unit_notes' => 1,
                'add_unit_note' => 1,
                'view_unit_notes' => 1,
                'view_campaigns' => 1,
                'view_all_campaigns' => 1,
                'add_campaigns' => 1,
                'modify_campaigns' => 1,
                'delete_campaigns' => 1,
                'add_campaign_note' => 1,
                'add_campaign_activity' => 1,
                'add_campaign_attachment' => 1,
                'view_any_campaign_notes' => 1,
                'view_any_campaign_activities' => 1,
                'view_any_campaign_attachments' => 1,
                'view_any_campaign_leads' => 1,
                'view_campaign_notes' => 1,
                'view_campaign_activities' => 1,
                'view_campaign_attachments' => 1,
                'delete_any_campaign_attachment' => 1,
                'restore_any_campaign_attachment' => 1,
                'view_campaign_leads' => 1,
                'view_campaign_ui_notes' => 1,
                'view_campaign_ui_activities' => 1,
                'view_campaign_ui_attachments' => 1,
                'view_campaign_ui_leads' => 1,
                'view_email_templates' => 1,
                'add_email_templates' => 1,
                'modify_email_templates' => 1,
                'add_email_attachment' => 1,
                'add_email_note' => 1,
                'delete_email_templates' => 1,
                'view_all_email_templates' => 1,
                'send_all_email_templates' => 1,
                'view_reports' => 1,
                'view_forecast' => 1,
                'add_forecast' => 1,
                'approve_sales' => 1,
                'manage_users' => 1,
                'view_users' => 1,
                'add_users' => 1,
                'delete_users' => 1,
                'deactiveate_users' => 1,
                'manage_roles' => 1,
                'add_roles' => 1,
                'modify_roles' => 1,
                'deactivate_roles' => 1,
                'modify_any_note' => 1,
                'delete_any_note' => 1,
                'restore_any_note' => 1,
                'close_any_activity' => 1,
                'view_any_activity' => 1,
                'modify_any_activity' => 1,
                'delete_any_activity' => 1,
                'restore_any_activities' => 1,
                'download_any_attachment' => 1,
                'download_assigned_attachment' => 1,
                'delete_any_attachment' => 1,
                'restore_any_attachment' => 1,
                'delete_any_campaign_client_relation' => 1,
                'restore_any_campaign_client_relation' => 1,
                'add_lead_note' => 1,
                'add_lead_attachment' => 1,
                'add_lead_activity' => 1,
                'add_lead_campaign' => 1,
                'add_customer_note' => 1,
                'add_customer_attachment' => 1,
                'add_customer_activity' => 1,
                'add_customer_campaign' => 1,
                'view_any_customer_note' => 1,
                'view_any_customer_activities' => 1,
                'view_any_customer_emails' => 1,
                'view_any_customer_attachments' => 1,
                'view_any_customer_campaigns' => 1,
                'view_parameters' => 1,
                'created_at' => '2014-11-15 23:37:23',
                'updated_at' => '2014-11-23 19:10:59',
            ),
            1 => 
            array (
                'id' => 2,
                'role_name' => 'Agent',
                'active' => 1,
                'created_by' => 5,
                'view_leads' => 1,
                'view_all_leads' => 0,
                'modify_all_leads' => 0,
                'email_all_leads' => 0,
                'delete_any_client_attachment' => 0,
                'restore_any_client_attachment' => 0,
                'view_any_lead_note' => 0,
                'view_any_lead_activities' => 0,
                'view_any_lead_emails' => 0,
                'view_any_lead_attachments' => 0,
                'view_any_lead_campaigns' => 0,
                'initially_assign_leads' => 0,
                'view_all_customers' => 0,
                'view_customers' => 1,
                'modify_all_customers' => 0,
                'delete_lead_info' => 0,
                'delete_customer_info' => 0,
                'delete_any_lead' => 0,
                'delete_any_customer' => 0,
                'restore_any_lead' => 0,
                'restore_any_customer' => 0,
                'convert_any_customer' => 0,
                'view_sales' => 0,
                'view_pending_sales' => 0,
                'reassign_leads' => 0,
                'add_projects' => 0,
                'view_projects' => 1,
                'delete_projects' => 0,
                'modify_projects' => 0,
                'view_project_commission_persentage' => 0,
                'delete_project_units' => 0,
                'add_project_units' => 0,
                'modify_project_units' => 0,
                'view_all_project_emails' => 0,
                'view_all_project_units' => 0,
                'view_all_project_notes' => 0,
                'view_project_notes' => 0,
                'add_project_notes' => 0,
                'view_all_projects' => 0,
                'view_project_ui_notes' => 0,
                'view_project_ui_emails' => 1,
                'view_project_ui_units' => 1,
                'view_all_units' => 1,
                'view_units' => 1,
                'add_units' => 0,
                'modify_units' => 0,
                'delete_units' => 0,
                'view_all_unit_notes' => 0,
                'add_unit_note' => 0,
                'view_unit_notes' => 0,
                'view_campaigns' => 1,
                'view_all_campaigns' => 0,
                'add_campaigns' => 0,
                'modify_campaigns' => 0,
                'delete_campaigns' => 0,
                'add_campaign_note' => 0,
                'add_campaign_activity' => 0,
                'add_campaign_attachment' => 0,
                'view_any_campaign_notes' => 0,
                'view_any_campaign_activities' => 0,
                'view_any_campaign_attachments' => 0,
                'view_any_campaign_leads' => 0,
                'view_campaign_notes' => 0,
                'view_campaign_activities' => 0,
                'view_campaign_attachments' => 1,
                'delete_any_campaign_attachment' => 0,
                'restore_any_campaign_attachment' => 0,
                'view_campaign_leads' => 0,
                'view_campaign_ui_notes' => 0,
                'view_campaign_ui_activities' => 0,
                'view_campaign_ui_attachments' => 1,
                'view_campaign_ui_leads' => 0,
                'view_email_templates' => 1,
                'add_email_templates' => 0,
                'modify_email_templates' => 0,
                'add_email_attachment' => 0,
                'add_email_note' => 0,
                'delete_email_templates' => 0,
                'view_all_email_templates' => 0,
                'send_all_email_templates' => 0,
                'view_reports' => 0,
                'view_forecast' => 0,
                'add_forecast' => 0,
                'approve_sales' => 0,
                'manage_users' => 0,
                'view_users' => 0,
                'add_users' => 0,
                'delete_users' => 0,
                'deactiveate_users' => 0,
                'manage_roles' => 0,
                'add_roles' => 0,
                'modify_roles' => 0,
                'deactivate_roles' => 0,
                'modify_any_note' => 0,
                'delete_any_note' => 0,
                'restore_any_note' => 0,
                'close_any_activity' => 0,
                'view_any_activity' => 0,
                'modify_any_activity' => 0,
                'delete_any_activity' => 0,
                'restore_any_activities' => 0,
                'download_any_attachment' => 0,
                'download_assigned_attachment' => 1,
                'delete_any_attachment' => 0,
                'restore_any_attachment' => 0,
                'delete_any_campaign_client_relation' => 1,
                'restore_any_campaign_client_relation' => 0,
                'add_lead_note' => 1,
                'add_lead_attachment' => 1,
                'add_lead_activity' => 1,
                'add_lead_campaign' => 1,
                'add_customer_note' => 1,
                'add_customer_attachment' => 1,
                'add_customer_activity' => 1,
                'add_customer_campaign' => 1,
                'view_any_customer_note' => 0,
                'view_any_customer_activities' => 0,
                'view_any_customer_emails' => 0,
                'view_any_customer_attachments' => 0,
                'view_any_customer_campaigns' => 0,
                'view_parameters' => 0,
                'created_at' => '2014-11-15 23:37:23',
                'updated_at' => '2014-11-15 23:37:23',
            ),
            2 => 
            array (
                'id' => 3,
                'role_name' => 'Receptionist',
                'active' => 1,
                'created_by' => 5,
                'view_leads' => 1,
                'view_all_leads' => 1,
                'modify_all_leads' => 0,
                'email_all_leads' => 0,
                'delete_any_client_attachment' => 0,
                'restore_any_client_attachment' => 0,
                'view_any_lead_note' => 0,
                'view_any_lead_activities' => 0,
                'view_any_lead_emails' => 0,
                'view_any_lead_attachments' => 0,
                'view_any_lead_campaigns' => 0,
                'initially_assign_leads' => 1,
                'view_all_customers' => 0,
                'view_customers' => 0,
                'modify_all_customers' => 0,
                'delete_lead_info' => 0,
                'delete_customer_info' => 0,
                'delete_any_lead' => 0,
                'delete_any_customer' => 0,
                'restore_any_lead' => 0,
                'restore_any_customer' => 0,
                'convert_any_customer' => 0,
                'view_sales' => 0,
                'view_pending_sales' => 0,
                'reassign_leads' => 0,
                'add_projects' => 0,
                'view_projects' => 1,
                'delete_projects' => 0,
                'modify_projects' => 0,
                'view_project_commission_persentage' => 0,
                'delete_project_units' => 0,
                'add_project_units' => 0,
                'modify_project_units' => 0,
                'view_all_project_emails' => 0,
                'view_all_project_units' => 0,
                'view_all_project_notes' => 0,
                'view_project_notes' => 1,
                'add_project_notes' => 0,
                'view_all_projects' => 0,
                'view_project_ui_notes' => 1,
                'view_project_ui_emails' => 1,
                'view_project_ui_units' => 1,
                'view_all_units' => 1,
                'view_units' => 1,
                'add_units' => 0,
                'modify_units' => 0,
                'delete_units' => 0,
                'view_all_unit_notes' => 0,
                'add_unit_note' => 0,
                'view_unit_notes' => 0,
                'view_campaigns' => 1,
                'view_all_campaigns' => 0,
                'add_campaigns' => 0,
                'modify_campaigns' => 0,
                'delete_campaigns' => 0,
                'add_campaign_note' => 0,
                'add_campaign_activity' => 0,
                'add_campaign_attachment' => 0,
                'view_any_campaign_notes' => 0,
                'view_any_campaign_activities' => 0,
                'view_any_campaign_attachments' => 0,
                'view_any_campaign_leads' => 0,
                'view_campaign_notes' => 0,
                'view_campaign_activities' => 0,
                'view_campaign_attachments' => 1,
                'delete_any_campaign_attachment' => 0,
                'restore_any_campaign_attachment' => 0,
                'view_campaign_leads' => 0,
                'view_campaign_ui_notes' => 0,
                'view_campaign_ui_activities' => 0,
                'view_campaign_ui_attachments' => 1,
                'view_campaign_ui_leads' => 0,
                'view_email_templates' => 1,
                'add_email_templates' => 0,
                'modify_email_templates' => 0,
                'add_email_attachment' => 0,
                'add_email_note' => 0,
                'delete_email_templates' => 0,
                'view_all_email_templates' => 0,
                'send_all_email_templates' => 0,
                'view_reports' => 0,
                'view_forecast' => 0,
                'add_forecast' => 0,
                'approve_sales' => 0,
                'manage_users' => 0,
                'view_users' => 0,
                'add_users' => 0,
                'delete_users' => 0,
                'deactiveate_users' => 0,
                'manage_roles' => 0,
                'add_roles' => 0,
                'modify_roles' => 0,
                'deactivate_roles' => 0,
                'modify_any_note' => 0,
                'delete_any_note' => 0,
                'restore_any_note' => 0,
                'close_any_activity' => 0,
                'view_any_activity' => 1,
                'modify_any_activity' => 1,
                'delete_any_activity' => 1,
                'restore_any_activities' => 0,
                'download_any_attachment' => 0,
                'download_assigned_attachment' => 0,
                'delete_any_attachment' => 0,
                'restore_any_attachment' => 0,
                'delete_any_campaign_client_relation' => 0,
                'restore_any_campaign_client_relation' => 0,
                'add_lead_note' => 0,
                'add_lead_attachment' => 0,
                'add_lead_activity' => 0,
                'add_lead_campaign' => 0,
                'add_customer_note' => 0,
                'add_customer_attachment' => 0,
                'add_customer_activity' => 0,
                'add_customer_campaign' => 0,
                'view_any_customer_note' => 0,
                'view_any_customer_activities' => 0,
                'view_any_customer_emails' => 0,
                'view_any_customer_attachments' => 0,
                'view_any_customer_campaigns' => 0,
                'view_parameters' => 0,
                'created_at' => '2014-02-08 23:37:23',
                'updated_at' => '2014-02-08 23:37:23',
            ),
        ));
        
        
    }
}