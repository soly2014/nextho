<?php

use Illuminate\Database\Seeder;

class CampaignTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('campaign_types')->delete();
        
        \DB::table('campaign_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'label' => '-None-',
                'sort_order' => 0,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            1 => 
            array (
                'id' => 2,
                'label' => 'Conference',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            2 => 
            array (
                'id' => 3,
                'label' => 'Webinar',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            3 => 
            array (
                'id' => 4,
                'label' => 'Trade Show',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            4 => 
            array (
                'id' => 5,
                'label' => 'Public Relations',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            5 => 
            array (
                'id' => 6,
                'label' => 'Partners',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            6 => 
            array (
                'id' => 7,
                'label' => 'Referral Program',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            7 => 
            array (
                'id' => 8,
                'label' => 'Advertisement',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2015-01-30 02:43:21',
            ),
            8 => 
            array (
                'id' => 9,
                'label' => 'Banner Ads',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            9 => 
            array (
                'id' => 10,
                'label' => 'Direct mail',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            10 => 
            array (
                'id' => 11,
                'label' => 'Email',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            11 => 
            array (
                'id' => 12,
                'label' => 'Telemarketing',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            12 => 
            array (
                'id' => 13,
                'label' => 'Others',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
            13 => 
            array (
                'id' => 16,
                'label' => 'SMS',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-02-16 13:13:10',
                'updated_at' => '2015-02-16 13:13:10',
            ),
            14 => 
            array (
                'id' => 17,
                'label' => 'SMS',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 9,
                'updated_by' => 9,
                'created_at' => '2015-02-16 13:13:56',
                'updated_at' => '2015-02-16 13:21:21',
            ),
            15 => 
            array (
                'id' => 18,
                'label' => 'SMS',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 9,
                'updated_by' => 9,
                'created_at' => '2015-02-16 13:14:00',
                'updated_at' => '2015-02-16 13:21:06',
            ),
            16 => 
            array (
                'id' => 19,
                'label' => 'SMS',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 9,
                'updated_by' => 9,
                'created_at' => '2015-02-16 13:14:19',
                'updated_at' => '2015-02-16 13:20:48',
            ),
            17 => 
            array (
                'id' => 20,
                'label' => 'sms',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 9,
                'updated_by' => 9,
                'created_at' => '2015-02-16 13:15:15',
                'updated_at' => '2015-02-16 13:16:45',
            ),
        ));
        
        
    }
}