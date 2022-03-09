<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VariantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('variants')->delete();
        
        \DB::table('variants')->insert(array (
            0 => 
            array (
                'id' => 1,
                'variant_type_id' => 1,
                'name' => 'Red',
                'bn_name' => 'লাল',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:53:06',
                'updated_at' => '2021-07-26 10:53:06',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'variant_type_id' => 1,
                'name' => 'Blue',
                'bn_name' => 'নীল',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:53:21',
                'updated_at' => '2021-07-26 10:53:21',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'variant_type_id' => 1,
                'name' => 'Black',
                'bn_name' => 'কালো',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:53:50',
                'updated_at' => '2021-07-26 10:53:50',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'variant_type_id' => 1,
                'name' => 'White',
                'bn_name' => 'সাদা',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:54:03',
                'updated_at' => '2021-07-26 10:54:03',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'variant_type_id' => 2,
                'name' => 'S',
                'bn_name' => 'ছোট',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:54:49',
                'updated_at' => '2021-07-26 10:54:49',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'variant_type_id' => 2,
                'name' => 'M',
                'bn_name' => 'মাঝারি',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:55:06',
                'updated_at' => '2021-07-26 10:55:06',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'variant_type_id' => 2,
                'name' => 'L',
                'bn_name' => 'বড়',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:55:28',
                'updated_at' => '2021-07-26 10:55:28',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'variant_type_id' => 3,
                'name' => 'Class-A',
                'bn_name' => 'এ ক্লাস',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:55:49',
                'updated_at' => '2021-07-26 10:55:49',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'variant_type_id' => 3,
                'name' => 'Class-B',
                'bn_name' => 'বি ক্লাস',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:59:52',
                'updated_at' => '2021-07-26 10:59:52',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'variant_type_id' => 3,
                'name' => 'Foreign',
                'bn_name' => 'বিদেশী',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 11:00:18',
                'updated_at' => '2021-07-26 11:00:18',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'variant_type_id' => 3,
                'name' => 'Local',
                'bn_name' => 'দেশী',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 11:00:32',
                'updated_at' => '2021-07-26 11:00:32',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}