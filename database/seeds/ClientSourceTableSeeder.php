<?php

use Illuminate\Database\Seeder;

class ClientSourceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('client_source')->delete();
        
        \DB::table('client_source')->insert(array (
            0 => 
            array (
                'id' => 3,
                'label' => 'Advertisement',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-11-15 23:37:23',
                'updated_at' => '2015-01-29 19:31:49',
            ),
            1 => 
            array (
                'id' => 4,
                'label' => 'Cold Call',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-11-15 23:37:23',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            2 => 
            array (
                'id' => 5,
                'label' => 'Employee Referral',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            3 => 
            array (
                'id' => 6,
                'label' => 'External Referral',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            4 => 
            array (
                'id' => 7,
                'label' => 'Online Store',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            5 => 
            array (
                'id' => 8,
                'label' => 'Partner',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            6 => 
            array (
                'id' => 9,
                'label' => 'Public Relations',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            7 => 
            array (
                'id' => 10,
                'label' => 'Sales Mail Alias',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 5,
                'updated_by' => 7,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2016-10-17 12:20:32',
            ),
            8 => 
            array (
                'id' => 11,
                'label' => 'Seminar Partner',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            9 => 
            array (
                'id' => 12,
                'label' => 'Seminar-Internal',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            10 => 
            array (
                'id' => 13,
                'label' => 'Trade Show',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            11 => 
            array (
                'id' => 14,
                'label' => 'Web Download',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            12 => 
            array (
                'id' => 15,
                'label' => 'Web Research',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            13 => 
            array (
                'id' => 16,
                'label' => 'Chat',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2014-12-12 19:25:41',
            ),
            14 => 
            array (
                'id' => 17,
                'label' => '-None-',
                'sort_order' => 0,
                'published' => 1,
                'created_by' => 5,
                'updated_by' => 7,
                'created_at' => '2014-12-12 19:25:41',
                'updated_at' => '2016-10-17 12:22:18',
            ),
            15 => 
            array (
                'id' => 18,
                'label' => 'Campaign - Test Source 1',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 5,
                'updated_by' => 9,
                'created_at' => '2015-01-18 11:42:44',
                'updated_at' => '2015-03-04 14:46:49',
            ),
            16 => 
            array (
                'id' => 20,
                'label' => 'Source Test',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 5,
                'updated_by' => 5,
                'created_at' => '2015-01-30 21:22:01',
                'updated_at' => '2015-01-30 21:22:23',
            ),
            17 => 
            array (
                'id' => 22,
                'label' => 'SMS',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-02-16 13:28:30',
                'updated_at' => '2015-02-16 13:28:30',
            ),
            18 => 
            array (
                'id' => 23,
                'label' => 'Google',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-02-18 14:04:01',
                'updated_at' => '2015-02-18 14:04:01',
            ),
            19 => 
            array (
                'id' => 24,
                'label' => 'Aqarmap',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 7,
                'created_at' => '2015-02-22 12:24:23',
                'updated_at' => '2015-02-22 12:42:30',
            ),
            20 => 
            array (
                'id' => 25,
                'label' => 'Aqarmap',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2015-02-22 12:24:42',
                'updated_at' => '2015-02-22 12:24:42',
            ),
            21 => 
            array (
                'id' => 26,
                'label' => 'Aqarmap',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 6,
                'created_at' => '2015-02-22 12:25:05',
                'updated_at' => '2015-02-22 12:43:38',
            ),
            22 => 
            array (
                'id' => 27,
                'label' => 'Aqarmap',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 6,
                'created_at' => '2015-02-22 12:25:38',
                'updated_at' => '2015-02-22 12:43:20',
            ),
            23 => 
            array (
                'id' => 28,
                'label' => 'Aqarmap',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 6,
                'created_at' => '2015-02-22 12:26:46',
                'updated_at' => '2015-02-22 12:43:03',
            ),
            24 => 
            array (
                'id' => 29,
                'label' => 'Aqarmap',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 6,
                'created_at' => '2015-02-22 12:27:48',
                'updated_at' => '2015-02-22 12:42:35',
            ),
            25 => 
            array (
                'id' => 30,
                'label' => 'Aqarmap',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 6,
                'created_at' => '2015-02-22 12:29:09',
                'updated_at' => '2015-02-22 12:42:00',
            ),
            26 => 
            array (
                'id' => 33,
                'label' => 'Customer recommendation ',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 6,
                'updated_by' => NULL,
                'created_at' => '2015-02-22 12:47:31',
                'updated_at' => '2015-02-22 12:47:31',
            ),
            27 => 
            array (
                'id' => 34,
                'label' => 'Client recommendation ',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 6,
                'updated_by' => NULL,
                'created_at' => '2015-02-22 12:49:50',
                'updated_at' => '2015-02-22 12:49:50',
            ),
            28 => 
            array (
                'id' => 35,
                'label' => 'Personal',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 6,
                'updated_by' => NULL,
                'created_at' => '2015-02-22 14:18:58',
                'updated_at' => '2015-02-22 14:18:58',
            ),
            29 => 
            array (
                'id' => 36,
                'label' => 'Walk in ',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-02-23 11:51:57',
                'updated_at' => '2015-02-23 11:51:57',
            ),
            30 => 
            array (
                'id' => 37,
                'label' => 'Facebook',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-03-01 15:39:54',
                'updated_at' => '2015-03-01 15:39:54',
            ),
            31 => 
            array (
                'id' => 38,
                'label' => 'Be website ',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 9,
                'updated_by' => 7,
                'created_at' => '2015-03-04 14:47:49',
                'updated_at' => '2015-10-15 00:14:21',
            ),
            32 => 
            array (
                'id' => 39,
                'label' => 'Campaign - leila New Cairo',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 6,
                'updated_by' => 7,
                'created_at' => '2015-03-05 12:34:53',
                'updated_at' => '2016-10-17 12:11:58',
            ),
            33 => 
            array (
                'id' => 40,
                'label' => 'Campaign - Eastown',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 6,
                'updated_by' => 7,
                'created_at' => '2015-03-08 13:43:41',
                'updated_at' => '2016-10-17 12:12:18',
            ),
            34 => 
            array (
                'id' => 41,
                'label' => 'Campaign - eastown raafat',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 6,
                'updated_by' => 7,
                'created_at' => '2015-03-08 14:49:32',
                'updated_at' => '2016-10-17 12:12:28',
            ),
            35 => 
            array (
                'id' => 42,
                'label' => 'Campaign - eastown heba',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 6,
                'updated_by' => 7,
                'created_at' => '2015-03-08 14:54:00',
                'updated_at' => '2016-10-17 12:12:36',
            ),
            36 => 
            array (
                'id' => 43,
                'label' => 'Campaign - Sheraton resale 199 m2',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 6,
                'updated_by' => 7,
                'created_at' => '2015-03-10 12:14:11',
                'updated_at' => '2016-10-17 12:12:46',
            ),
            37 => 
            array (
                'id' => 44,
                'label' => 'Campaign - Koronfel new cairo ',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 6,
                'updated_by' => 7,
                'created_at' => '2015-03-10 16:54:03',
                'updated_at' => '2016-10-17 12:12:52',
            ),
            38 => 
            array (
                'id' => 45,
                'label' => 'Adminstration',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2015-03-23 16:33:35',
                'updated_at' => '2015-03-23 16:33:35',
            ),
            39 => 
            array (
                'id' => 46,
                'label' => 'Linked In',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => NULL,
                'created_at' => '2015-03-26 14:20:51',
                'updated_at' => '2015-03-26 14:20:51',
            ),
            40 => 
            array (
                'id' => 47,
                'label' => 'OLX',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 9,
                'updated_by' => 7,
                'created_at' => '2015-04-09 17:15:32',
                'updated_at' => '2017-01-08 13:18:16',
            ),
            41 => 
            array (
                'id' => 48,
                'label' => 'Masrawy',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2015-04-14 16:51:55',
                'updated_at' => '2015-04-14 16:51:55',
            ),
            42 => 
            array (
                'id' => 49,
                'label' => 'Campaign - Shiraton - Masrway ',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 9,
                'updated_by' => 7,
                'created_at' => '2015-04-14 17:11:27',
                'updated_at' => '2016-10-17 12:13:05',
            ),
            43 => 
            array (
                'id' => 50,
                'label' => 'Campaign - Nasr City Apart.',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 6,
                'updated_by' => 7,
                'created_at' => '2015-04-15 13:38:32',
                'updated_at' => '2016-10-17 12:13:14',
            ),
            44 => 
            array (
                'id' => 51,
                'label' => 'Campaign - Sheraton resale 199 m2',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 6,
                'updated_by' => 7,
                'created_at' => '2015-04-15 13:40:22',
                'updated_at' => '2016-10-17 12:13:23',
            ),
            45 => 
            array (
                'id' => 52,
                'label' => 'Campaign - sabiduria sms',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 6,
                'updated_by' => 7,
                'created_at' => '2015-04-19 16:17:14',
                'updated_at' => '2016-10-17 12:13:30',
            ),
            46 => 
            array (
                'id' => 53,
                'label' => 'Campaign - sheraton  199 m2',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 6,
                'updated_by' => 7,
                'created_at' => '2015-05-03 13:17:48',
                'updated_at' => '2016-10-17 12:13:39',
            ),
            47 => 
            array (
                'id' => 54,
                'label' => 'Campaign - sms bait el watn',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 6,
                'updated_by' => 7,
                'created_at' => '2015-05-07 14:19:54',
                'updated_at' => '2016-10-17 12:13:48',
            ),
            48 => 
            array (
                'id' => 55,
                'label' => 'Website',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2015-10-15 00:14:56',
                'updated_at' => '2015-10-15 00:14:56',
            ),
            49 => 
            array (
                'id' => 56,
                'label' => 'Mobawab',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2016-02-07 16:42:32',
                'updated_at' => '2016-02-07 16:42:32',
            ),
            50 => 
            array (
                'id' => 57,
                'label' => 'Mobawab',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 7,
                'created_at' => '2016-02-07 16:43:02',
                'updated_at' => '2016-02-07 16:44:22',
            ),
            51 => 
            array (
                'id' => 58,
                'label' => 'E-Mails',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2016-10-17 12:14:09',
                'updated_at' => '2016-10-17 12:14:09',
            ),
            52 => 
            array (
                'id' => 59,
                'label' => 'E-Mails',
                'sort_order' => 1,
                'published' => 0,
                'created_by' => 7,
                'updated_by' => 7,
                'created_at' => '2016-10-17 12:14:16',
                'updated_at' => '2016-10-17 12:19:34',
            ),
            53 => 
            array (
                'id' => 60,
                'label' => 'Instagram',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2017-08-21 13:03:41',
                'updated_at' => '2017-08-21 13:03:41',
            ),
            54 => 
            array (
                'id' => 61,
                'label' => 'External Broker ',
                'sort_order' => 1,
                'published' => 1,
                'created_by' => 7,
                'updated_by' => NULL,
                'created_at' => '2017-08-21 13:06:34',
                'updated_at' => '2017-08-21 13:06:34',
            ),
        ));
        
        
    }
}