<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VariantTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('variant_types')->delete();
        
        \DB::table('variant_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Color',
                'bn_name' => 'রঙ',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:49:27',
                'updated_at' => '2021-07-26 10:49:27',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Size',
                'bn_name' => 'সাইজ',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:49:44',
                'updated_at' => '2021-07-26 10:49:44',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Class',
                'bn_name' => 'শ্রেণি',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2021-07-26 10:51:24',
                'updated_at' => '2021-07-26 10:51:56',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}