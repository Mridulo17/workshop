<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('types')->delete();
        
        \DB::table('types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Vehicle',
                'bn_name' => 'গাড়ি',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-12 13:41:53',
                'updated_at' => '2021-09-12 13:41:53',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Pump',
                'bn_name' => 'পাম্প',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-12 13:42:06',
                'updated_at' => '2021-09-12 13:42:06',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Equipment',
                'bn_name' => 'সরঞ্জাম',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-12 13:42:27',
                'updated_at' => '2021-09-12 13:42:27',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}