<?php

use Illuminate\Database\Seeder;

class ActivityTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('activity_types')->delete();
        
        \DB::table('activity_types')->insert(array (
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
                'label' => 'Email',
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
                'label' => 'Call',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2015-01-30 03:52:24',
            ),
            3 => 
            array (
                'id' => 4,
                'label' => 'Meeting',
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
                'label' => 'Send Letter',
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
                'label' => 'Site Visit',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2015-04-05 06:30:17',
            ),
        ));
        
        
    }
}