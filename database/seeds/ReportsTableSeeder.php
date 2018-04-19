<?php

use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('reports')->delete();
        
        \DB::table('reports')->insert(array (
            0 => 
            array (
                'id' => 1,
                'report_name' => 'Clients Acquisition Report',
                'number_generated' => 9,
                'last_generated_at' => '2017-07-29 02:32:22',
                'user_id' => 5,
                'active' => 1,
                'route' => 'report-client-acquisition',
                'created_at' => '2015-01-13 17:31:11',
                'updated_at' => '2017-07-29 02:32:22',
            ),
            1 => 
            array (
                'id' => 2,
            'report_name' => 'Clients Acquisition Report (Projects)',
                'number_generated' => 5,
                'last_generated_at' => '2015-07-28 14:00:34',
                'user_id' => 5,
                'active' => 1,
                'route' => 'report-client-acquisition-projects',
                'created_at' => '2015-01-13 17:31:11',
                'updated_at' => '2015-07-28 14:00:34',
            ),
            2 => 
            array (
                'id' => 3,
            'report_name' => 'Clients Acquisition Report (Units)',
                'number_generated' => 3,
                'last_generated_at' => '2015-01-18 02:59:54',
                'user_id' => 5,
                'active' => 1,
                'route' => 'report-client-acquisition-units',
                'created_at' => '2015-01-13 17:31:11',
                'updated_at' => '2015-01-18 02:59:54',
            ),
            3 => 
            array (
                'id' => 4,
                'report_name' => 'Sales Report',
                'number_generated' => 10,
                'last_generated_at' => '2017-03-26 14:23:24',
                'user_id' => 5,
                'active' => 1,
                'route' => 'report-sales',
                'created_at' => '2015-01-13 17:31:11',
                'updated_at' => '2017-03-26 14:23:24',
            ),
            4 => 
            array (
                'id' => 5,
            'report_name' => 'Sales Report (Project)',
                'number_generated' => 2,
                'last_generated_at' => '2015-07-28 13:57:47',
                'user_id' => 5,
                'active' => 1,
                'route' => 'report-sales-projects',
                'created_at' => '2015-01-13 17:31:11',
                'updated_at' => '2015-07-28 13:57:47',
            ),
            5 => 
            array (
                'id' => 6,
            'report_name' => 'Sales Report (Units)',
                'number_generated' => 6,
                'last_generated_at' => '2017-07-11 18:24:20',
                'user_id' => 5,
                'active' => 1,
                'route' => 'report-sales-units',
                'created_at' => '2015-01-13 17:31:11',
                'updated_at' => '2017-07-11 18:24:20',
            ),
            6 => 
            array (
                'id' => 7,
                'report_name' => 'Clients Sources',
                'number_generated' => 60,
                'last_generated_at' => '2017-03-11 10:15:02',
                'user_id' => 5,
                'active' => 1,
                'route' => 'report-sources',
                'created_at' => '2015-01-13 17:31:11',
                'updated_at' => '2017-03-11 10:15:02',
            ),
            7 => 
            array (
                'id' => 8,
            'report_name' => 'Clients Sources (Leads)',
                'number_generated' => 0,
                'last_generated_at' => NULL,
                'user_id' => 5,
                'active' => 1,
                'route' => 'report-sources-leads',
                'created_at' => '2015-04-14 11:37:56',
                'updated_at' => '2015-04-14 11:37:56',
            ),
        ));
        
        
    }
}