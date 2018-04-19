<?php

use Illuminate\Database\Seeder;

class ActivityStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('activity_status')->delete();
        
        \DB::table('activity_status')->insert(array (
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
                'label' => 'Deferred',
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
                'label' => 'In Progress',
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
                'label' => 'Completed',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2015-01-30 04:01:20',
            ),
            4 => 
            array (
                'id' => 5,
                'label' => 'Waiting on someone else',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-14 18:30:55',
                'updated_at' => '2014-12-14 18:30:55',
            ),
        ));
        
        
    }
}