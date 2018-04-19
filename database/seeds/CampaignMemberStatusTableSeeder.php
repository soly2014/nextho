<?php

use Illuminate\Database\Seeder;

class CampaignMemberStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('campaign_member_status')->delete();
        
        \DB::table('campaign_member_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'label' => 'Planned',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            1 => 
            array (
                'id' => 2,
                'label' => 'Invited',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            2 => 
            array (
                'id' => 3,
                'label' => 'Sent',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            3 => 
            array (
                'id' => 4,
                'label' => 'Received',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            4 => 
            array (
                'id' => 5,
                'label' => 'Opened',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            5 => 
            array (
                'id' => 6,
                'label' => 'Responded',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            6 => 
            array (
                'id' => 7,
                'label' => 'Bounced',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            7 => 
            array (
                'id' => 8,
                'label' => 'Opted Out',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
        ));
        
        
    }
}