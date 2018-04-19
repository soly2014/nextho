<?php

use Illuminate\Database\Seeder;

class ProjectDistrictTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('project_district')->delete();
        
        \DB::table('project_district')->insert(array (
            0 => 
            array (
                'id' => 1,
                'label' => '-None-',
                'sort_order' => 0,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            1 => 
            array (
                'id' => 2,
                'label' => '6 October',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2015-01-30 03:11:49',
            ),
            2 => 
            array (
                'id' => 3,
                'label' => 'New Cairo',
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
                'label' => 'North Coast',
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
                'label' => 'Hurghada',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => NULL,
                'created_at' => '2014-12-17 18:30:55',
                'updated_at' => '2014-12-17 18:30:55',
            ),
            5 => 
            array (
                'id' => 7,
                'label' => 'El Sheikh Zayed',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => 7,
                'created_at' => '2015-02-15 22:59:11',
                'updated_at' => '2016-09-07 15:48:38',
            ),
            6 => 
            array (
                'id' => 8,
                'label' => 'Shiraton',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-02-16 13:29:17',
                'updated_at' => '2015-02-16 13:29:17',
            ),
            7 => 
            array (
                'id' => 9,
                'label' => 'El Sherouk City ',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 6,
                'updated_by' => NULL,
                'created_at' => '2015-02-22 12:51:02',
                'updated_at' => '2015-02-22 12:51:02',
            ),
            8 => 
            array (
                'id' => 10,
                'label' => 'Ras Sedr',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-03-03 14:33:11',
                'updated_at' => '2015-03-03 14:33:11',
            ),
            9 => 
            array (
                'id' => 11,
                'label' => 'Ras Sedr',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 9,
                'updated_by' => 9,
                'created_at' => '2015-03-03 14:33:18',
                'updated_at' => '2015-03-05 12:19:08',
            ),
            10 => 
            array (
                'id' => 12,
                'label' => 'Heliopolis',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-03-05 12:20:30',
                'updated_at' => '2015-03-05 12:20:30',
            ),
            11 => 
            array (
                'id' => 13,
                'label' => 'Maadi',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-03-15 11:34:16',
                'updated_at' => '2015-03-15 11:34:16',
            ),
            12 => 
            array (
                'id' => 14,
                'label' => 'Dokki',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-03-26 11:57:25',
                'updated_at' => '2015-03-26 11:57:25',
            ),
            13 => 
            array (
                'id' => 15,
                'label' => 'Nasr City',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2015-04-02 12:38:10',
                'updated_at' => '2015-04-02 12:38:10',
            ),
            14 => 
            array (
                'id' => 16,
                'label' => 'Nasr City',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 7,
                'created_at' => '2015-04-02 12:38:17',
                'updated_at' => '2015-04-02 12:40:07',
            ),
            15 => 
            array (
                'id' => 17,
                'label' => 'El Sokhna',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-04-23 15:41:25',
                'updated_at' => '2015-04-23 15:41:25',
            ),
            16 => 
            array (
                'id' => 18,
                'label' => 'New Heliopolis',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2015-05-10 13:30:41',
                'updated_at' => '2015-05-10 13:30:41',
            ),
            17 => 
            array (
                'id' => 19,
                'label' => 'Cold Call',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2016-01-20 11:35:31',
                'updated_at' => '2016-01-20 11:35:31',
            ),
            18 => 
            array (
                'id' => 20,
                'label' => 'El Gouna',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2016-10-02 17:30:07',
                'updated_at' => '2016-10-02 17:30:07',
            ),
            19 => 
            array (
                'id' => 21,
                'label' => 'El Gouna',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 7,
                'created_at' => '2016-10-02 17:30:19',
                'updated_at' => '2016-10-06 17:05:47',
            ),
            20 => 
            array (
                'id' => 22,
                'label' => 'Mohandseen',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2016-10-30 12:22:39',
                'updated_at' => '2016-10-30 12:22:39',
            ),
            21 => 
            array (
                'id' => 23,
                'label' => 'New Heliopolis',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 7,
                'created_at' => '2017-09-14 16:53:52',
                'updated_at' => '2017-09-14 16:55:46',
            ),
            22 => 
            array (
                'id' => 24,
                'label' => 'New Capital ',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2017-10-02 19:54:48',
                'updated_at' => '2017-10-02 19:54:48',
            ),
            23 => 
            array (
                'id' => 25,
                'label' => 'Future City ',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2017-10-14 13:38:01',
                'updated_at' => '2017-10-14 13:38:01',
            ),
        ));
        
        
    }
}