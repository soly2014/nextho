<?php

use Illuminate\Database\Seeder;

class UnitFinishsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('unit_finishs')->delete();
        
        \DB::table('unit_finishs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'label' => 'Finished',
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
                'label' => 'Semi-Finished',
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
                'label' => 'Not Finished',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2015-01-30 03:31:47',
            ),
        ));
        
        
    }
}