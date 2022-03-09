<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WorkshopsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('workshops')->delete();
        
        \DB::table('workshops')->insert(array (
            0 => 
            array (
                'id' => 1,
                'division_id' => 6,
                'name' => 'Central Workshop, Dhaka',
                'bn_name' => 'কেন্দ্রীয় কারিগরী কারখানা, ঢাকা',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-08-01 09:55:02',
                'updated_at' => '2021-08-01 09:55:02',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'division_id' => 6,
                'name' => 'Divisional Workshop, Chittagong',
                'bn_name' => 'বিভাগীয় কারিগরি কারখানা, চট্টগ্রাম',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-08-01 09:56:33',
                'updated_at' => '2021-08-01 09:56:33',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'division_id' => 2,
                'name' => 'Divisional Workshop, Rajshahi',
                'bn_name' => 'বিভাগীয় কারিগরী কারখানা, রাজশাহী',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-08-01 09:57:25',
                'updated_at' => '2021-08-01 09:57:25',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'division_id' => 3,
                'name' => 'Divisional Workshop, Khulna',
                'bn_name' => 'বিভাগীয় কারিগরি কারখানা, খুলনা',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-08-01 09:57:54',
                'updated_at' => '2021-08-01 09:57:54',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'division_id' => 5,
                'name' => 'Divisional Workshop, Sylhet',
                'bn_name' => 'বিভাগীয় কারিগরি কারখানা, সিলেট',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-08-01 09:58:56',
                'updated_at' => '2021-08-01 09:58:56',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'division_id' => 4,
                'name' => 'Divisional Workshop, Barisal',
                'bn_name' => 'বিভাগীয় কারিগরি কারখানা, বরিশাল',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-08-01 09:59:16',
                'updated_at' => '2021-08-01 09:59:16',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'division_id' => 7,
                'name' => 'Divisional Workshop, Rangpur',
                'bn_name' => 'বিভাগীয় কারিগরি কারখানা, রংপুর',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-08-01 09:59:41',
                'updated_at' => '2021-08-01 09:59:41',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'division_id' => 8,
                'name' => 'Divisional Workshop, Mymensingh',
                'bn_name' => 'বিভাগীয় কারিগরি কারখানা, ময়মনসিংহ',
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-08-01 10:00:33',
                'updated_at' => '2021-08-01 10:00:33',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}