<?php

use Illuminate\Database\Seeder;

class ClientStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('client_status')->delete();
        
        \DB::table('client_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'label' => 'Attempted to Contact',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 5,
                'updated_by' => 9,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2015-02-23 11:52:36',
            ),
            1 => 
            array (
                'id' => 2,
                'label' => 'Contact in Future',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 5,
                'updated_by' => 9,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2015-02-23 11:53:01',
            ),
            2 => 
            array (
                'id' => 3,
                'label' => 'Interested ',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 9,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2015-02-23 11:53:44',
            ),
            3 => 
            array (
                'id' => 4,
                'label' => 'Not Interested ',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 9,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2015-02-23 11:54:33',
            ),
            4 => 
            array (
                'id' => 5,
                'label' => 'Lost Lead',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            5 => 
            array (
                'id' => 6,
                'label' => 'Not Contacted',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 5,
                'updated_by' => 9,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2015-02-23 11:53:16',
            ),
            6 => 
            array (
                'id' => 7,
                'label' => 'Pre Qualified',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 5,
                'updated_by' => 9,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2015-02-23 11:53:24',
            ),
            7 => 
            array (
                'id' => 9,
                'label' => '-None-',
                'sort_order' => 0,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
        ));
        
        
    }
}