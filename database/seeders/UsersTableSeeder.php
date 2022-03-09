<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'division_id' => NULL,
                'district_id' => NULL,
                'fire_station_id' => NULL,
                'employer_id' => NULL,
                'workshop_id' => NULL,
                'name' => 'Super User',
                'bn_name' => 'সুপার ইউজার',
                'username' => 'super',
                'mobile' => NULL,
                'phone_no' => NULL,
                'email' => 'super@gmail.com',
                'nid' => NULL,
                'address' => NULL,
                'signature' => '',
                'email_verified_at' => '2021-07-06 09:39:10',
                'password' => '$2y$10$RY3G5SWVIpkl8GfuP9qmYeoIPXkYHqNq9qiBfFcqBxJqMLTAe9B76',
                'dob' => '1995-01-10',
                'status' => 'Active',
                'permission_as_role' => 'Yes',
                'remember_token' => 'pOwclLa5rreS75XIHYyuc8v7ybe5h9tnuIVpsGYSOyZOxruVxfUlk4A3c4N5',
                'created_at' => '2021-02-24 20:36:02',
                'updated_at' => '2021-09-07 12:00:58',
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 2,
                'division_id' => NULL,
                'district_id' => NULL,
                'fire_station_id' => NULL,
                'employer_id' => NULL,
                'workshop_id' => 1,
                'name' => 'Admin',
                'bn_name' => 'এডমিন',
                'username' => 'admin',
                'mobile' => NULL,
                'phone_no' => NULL,
                'email' => 'admin@gmail.com',
                'nid' => NULL,
                'address' => NULL,
                'signature' => NULL,
                'email_verified_at' => '2021-09-07 12:01:55',
                'password' => '$2y$10$vZ00VD4qEmnI9MXhLiXo2.XiHBMEi2YEriNDMK8FhnvFuh7ZqBmaq',
                'dob' => NULL,
                'status' => 'Active',
                'permission_as_role' => 'Yes',
                'remember_token' => 'ZMFO6FJm2QkbWabLqT3rtJZDoQ55Esja6W7LUbXgEa0YMWfgnTJ8tDpMgQEG',
                'created_at' => '2021-09-07 12:01:55',
                'updated_at' => '2021-09-07 12:01:55',
            ),
        ));
        
        
    }
}