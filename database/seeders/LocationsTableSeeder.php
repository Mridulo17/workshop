<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('locations')->delete();
        
        \DB::table('locations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'lat' => '23.722300975024343',
                'lng' => '90.40599605877617',
                'name' => 'Central Workshop, Dhaka',
                'location_type' => 'workshop',
                'location_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'lat' => '22.335364800857903',
                'lng' => '91.81265207392386',
                'name' => 'Chittagong Workshop',
                'location_type' => 'workshop',
                'location_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'lat' => '24.36935255100024',
                'lng' => '88.5893322360739',
                'name' => 'Rajshahi Workshop',
                'location_type' => 'workshop',
                'location_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'lat' => '22.83433487521905',
                'lng' => '89.54814863633423',
                'name' => 'Khulna Workshop',
                'location_type' => 'workshop',
                'location_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'lat' => '24.890976396083097',
                'lng' => '91.86506312187365',
                'name' => 'Sylhet Workshop',
                'location_type' => 'workshop',
                'location_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'lat' => '22.703826603951015',
                'lng' => '90.37468181734654',
                'name' => 'Barisal Workshop',
                'location_type' => 'workshop',
                'location_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'lat' => '25.747473098233705',
                'lng' => '89.25909430561913',
                'name' => 'Rangpur Workshop',
                'location_type' => 'workshop',
                'location_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'lat' => '24.764941693244673',
                'lng' => '90.40215931303746',
                'name' => 'Mymensingh Workshop',
                'location_type' => 'workshop',
                'location_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}