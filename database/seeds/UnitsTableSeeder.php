<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'id' => 1,
                'property_id' => '4814',
                'property_type' => 5,
                'property_status' => 'Rent',
                'price' => 450000.0,
                'area' => NULL,
                'bathrooms' => 6,
                'bedrooms' => NULL,
                'finish' => 1,
                'floor' => NULL,
                'garden_area' => 300.0,
                'number_of_apartments_Floor' => NULL,
                'number_of_elevators' => NULL,
                'number_of_floors' => NULL,
                'percentage_of_built_area' => NULL,
                'elevator' => 0,
                'garage' => 0,
                'garden' => NULL,
                'roof' => NULL,
                'roof_terrace' => 0,
                'total_built_area' => '330',
                'total_land_area' => '450',
                'address' => 'Allegria',
                'district' => 7,
                'commision_percentage' => 1.0,
                'description' => 'Fully-Finished --- 8 Air Conditioner --- Heaters',
                'sold' => 1,
                'on_hold' => 0,
                'created_by' => 7,
                'updated_by' => 7,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2016-06-10 14:43:42',
                'updated_at' => '2016-06-16 15:45:49',
            ),
            1 => 
            array (
                'id' => 2,
                'property_id' => '1323',
                'property_type' => 5,
                'property_status' => 'Rent',
                'price' => 450000.0,
                'area' => NULL,
                'bathrooms' => 6,
                'bedrooms' => NULL,
                'finish' => 1,
                'floor' => NULL,
                'garden_area' => 300.0,
                'number_of_apartments_Floor' => NULL,
                'number_of_elevators' => NULL,
                'number_of_floors' => NULL,
                'percentage_of_built_area' => NULL,
                'elevator' => 0,
                'garage' => 0,
                'garden' => NULL,
                'roof' => NULL,
                'roof_terrace' => 0,
                'total_built_area' => '330',
                'total_land_area' => '450',
                'address' => 'El Sheikh Zayed',
                'district' => 7,
                'commision_percentage' => 1.0,
                'description' => '',
                'sold' => 1,
                'on_hold' => 0,
                'created_by' => 7,
                'updated_by' => 7,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2016-06-16 15:27:31',
                'updated_at' => '2016-06-16 15:44:10',
            ),
        ));
        
        
    }
}