<?php

use Illuminate\Database\Seeder;

class UnitTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('unit_types')->delete();
        
        \DB::table('unit_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'label' => 'Apartment',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2015-01-30 03:21:46',
            ),
            1 => 
            array (
                'id' => 2,
                'label' => 'Duplex',
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
                'label' => 'Twin House',
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
                'label' => 'Townhouse',
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
                'label' => 'Villa',
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
                'label' => 'I Villa',
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
                'label' => 'Chalet',
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
                'label' => 'Studio',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            8 => 
            array (
                'id' => 9,
                'label' => 'Penthouse',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 7,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2016-01-12 22:19:33',
            ),
            9 => 
            array (
                'id' => 10,
                'label' => '-None-',
                'sort_order' => 0,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            10 => 
            array (
                'id' => 11,
                'label' => 'Building',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            11 => 
            array (
                'id' => 12,
                'label' => 'Land',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            12 => 
            array (
                'id' => 13,
                'label' => 'Commercial ',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 6,
                'updated_by' => NULL,
                'created_at' => '2015-03-02 13:46:34',
                'updated_at' => '2015-03-02 13:46:34',
            ),
            13 => 
            array (
                'id' => 14,
                'label' => 'pharmacy',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2015-03-21 16:09:38',
                'updated_at' => '2015-03-21 16:09:38',
            ),
            14 => 
            array (
                'id' => 15,
                'label' => 'Investment',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2015-04-05 13:26:26',
                'updated_at' => '2015-04-05 13:26:26',
            ),
            15 => 
            array (
                'id' => 16,
                'label' => 'Quatro',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2016-01-12 22:32:03',
                'updated_at' => '2016-01-12 22:32:03',
            ),
            16 => 
            array (
                'id' => 17,
                'label' => 'Administrative',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2016-01-12 22:52:58',
                'updated_at' => '2016-01-12 22:52:58',
            ),
            17 => 
            array (
                'id' => 18,
                'label' => 'Cold Call',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2016-01-20 11:33:51',
                'updated_at' => '2016-01-20 11:33:51',
            ),
            18 => 
            array (
                'id' => 19,
                'label' => 'Cold Call',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 7,
                'created_at' => '2016-01-20 11:34:17',
                'updated_at' => '2016-01-20 11:35:12',
            ),
        ));
        
        
    }
}