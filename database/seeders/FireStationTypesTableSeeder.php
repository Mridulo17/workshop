<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FireStationTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fire_station_types')->delete();
        
        \DB::table('fire_station_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'A Class',
                'bn_name' => 'এ শ্রেনী',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2021-03-01 22:59:11',
                'updated_at' => '2021-03-01 23:44:13',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'B Class',
                'bn_name' => 'বি শ্রেণী',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2021-03-16 01:18:29',
                'updated_at' => '2021-03-16 01:18:29',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'C Class',
                'bn_name' => 'সি শ্রেণী',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2021-03-16 01:18:29',
                'updated_at' => '2021-03-16 01:18:29',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'River',
                'bn_name' => 'নদী',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2021-03-16 01:21:35',
                'updated_at' => '2021-03-16 01:21:35',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Land Side River',
                'bn_name' => 'স্থল কাম নদী',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2021-03-16 01:21:35',
                'updated_at' => '2021-03-16 01:21:35',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}