<?php

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2018_03_01_163207_create_activities_table',
                'batch' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2018_03_01_163207_create_activity_status_table',
                'batch' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2018_03_01_163207_create_activity_types_table',
                'batch' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2018_03_01_163207_create_attachments_table',
                'batch' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'migration' => '2018_03_01_163207_create_campaign_client_table',
                'batch' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'migration' => '2018_03_01_163207_create_campaign_member_status_table',
                'batch' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'migration' => '2018_03_01_163207_create_campaign_status_table',
                'batch' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'migration' => '2018_03_01_163207_create_campaign_types_table',
                'batch' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'migration' => '2018_03_01_163207_create_campaigns_table',
                'batch' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'migration' => '2018_03_01_163207_create_client_email_template_table',
                'batch' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'migration' => '2018_03_01_163207_create_client_properties_table',
                'batch' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'migration' => '2018_03_01_163207_create_client_source_table',
                'batch' => 0,
            ),
            12 => 
            array (
                'id' => 13,
                'migration' => '2018_03_01_163207_create_client_status_table',
                'batch' => 0,
            ),
            13 => 
            array (
                'id' => 14,
                'migration' => '2018_03_01_163207_create_clients_table',
                'batch' => 0,
            ),
            14 => 
            array (
                'id' => 15,
                'migration' => '2018_03_01_163207_create_clients_users_table',
                'batch' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'migration' => '2018_03_01_163207_create_email_templates_table',
                'batch' => 0,
            ),
            16 => 
            array (
                'id' => 17,
                'migration' => '2018_03_01_163207_create_forecast_table',
                'batch' => 0,
            ),
            17 => 
            array (
                'id' => 18,
                'migration' => '2018_03_01_163207_create_notes_table',
                'batch' => 0,
            ),
            18 => 
            array (
                'id' => 19,
                'migration' => '2018_03_01_163207_create_project_district_table',
                'batch' => 0,
            ),
            19 => 
            array (
                'id' => 20,
                'migration' => '2018_03_01_163207_create_project_units_table',
                'batch' => 0,
            ),
            20 => 
            array (
                'id' => 21,
                'migration' => '2018_03_01_163207_create_projects_table',
                'batch' => 0,
            ),
            21 => 
            array (
                'id' => 22,
                'migration' => '2018_03_01_163207_create_reports_table',
                'batch' => 0,
            ),
            22 => 
            array (
                'id' => 23,
                'migration' => '2018_03_01_163207_create_roles_table',
                'batch' => 0,
            ),
            23 => 
            array (
                'id' => 24,
                'migration' => '2018_03_01_163207_create_sale_info_table',
                'batch' => 0,
            ),
            24 => 
            array (
                'id' => 25,
                'migration' => '2018_03_01_163207_create_unit_finishs_table',
                'batch' => 0,
            ),
            25 => 
            array (
                'id' => 26,
                'migration' => '2018_03_01_163207_create_unit_types_table',
                'batch' => 0,
            ),
            26 => 
            array (
                'id' => 27,
                'migration' => '2018_03_01_163207_create_units_table',
                'batch' => 0,
            ),
            27 => 
            array (
                'id' => 28,
                'migration' => '2018_03_01_163207_create_user_actions_table',
                'batch' => 0,
            ),
            28 => 
            array (
                'id' => 29,
                'migration' => '2018_03_01_163207_create_users_table',
                'batch' => 0,
            ),
            29 => 
            array (
                'id' => 30,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_activities_table',
                'batch' => 0,
            ),
            30 => 
            array (
                'id' => 31,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_activity_status_table',
                'batch' => 0,
            ),
            31 => 
            array (
                'id' => 32,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_activity_types_table',
                'batch' => 0,
            ),
            32 => 
            array (
                'id' => 33,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_attachments_table',
                'batch' => 0,
            ),
            33 => 
            array (
                'id' => 34,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_campaign_client_table',
                'batch' => 0,
            ),
            34 => 
            array (
                'id' => 35,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_campaign_member_status_table',
                'batch' => 0,
            ),
            35 => 
            array (
                'id' => 36,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_campaign_status_table',
                'batch' => 0,
            ),
            36 => 
            array (
                'id' => 37,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_campaign_types_table',
                'batch' => 0,
            ),
            37 => 
            array (
                'id' => 38,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_campaigns_table',
                'batch' => 0,
            ),
            38 => 
            array (
                'id' => 39,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_client_email_template_table',
                'batch' => 0,
            ),
            39 => 
            array (
                'id' => 40,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_client_source_table',
                'batch' => 0,
            ),
            40 => 
            array (
                'id' => 41,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_client_status_table',
                'batch' => 0,
            ),
            41 => 
            array (
                'id' => 42,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_clients_table',
                'batch' => 0,
            ),
            42 => 
            array (
                'id' => 43,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_clients_users_table',
                'batch' => 0,
            ),
            43 => 
            array (
                'id' => 44,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_email_templates_table',
                'batch' => 0,
            ),
            44 => 
            array (
                'id' => 45,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_forecast_table',
                'batch' => 0,
            ),
            45 => 
            array (
                'id' => 46,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_notes_table',
                'batch' => 0,
            ),
            46 => 
            array (
                'id' => 47,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_project_district_table',
                'batch' => 0,
            ),
            47 => 
            array (
                'id' => 48,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_project_units_table',
                'batch' => 0,
            ),
            48 => 
            array (
                'id' => 49,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_projects_table',
                'batch' => 0,
            ),
            49 => 
            array (
                'id' => 50,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_reports_table',
                'batch' => 0,
            ),
            50 => 
            array (
                'id' => 51,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_roles_table',
                'batch' => 0,
            ),
            51 => 
            array (
                'id' => 52,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_sale_info_table',
                'batch' => 0,
            ),
            52 => 
            array (
                'id' => 53,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_unit_finishs_table',
                'batch' => 0,
            ),
            53 => 
            array (
                'id' => 54,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_unit_types_table',
                'batch' => 0,
            ),
            54 => 
            array (
                'id' => 55,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_units_table',
                'batch' => 0,
            ),
            55 => 
            array (
                'id' => 56,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_user_actions_table',
                'batch' => 0,
            ),
            56 => 
            array (
                'id' => 57,
                'migration' => '2018_03_01_163211_add_foreign_keys_to_users_table',
                'batch' => 0,
            ),
        ));
        
        
    }
}