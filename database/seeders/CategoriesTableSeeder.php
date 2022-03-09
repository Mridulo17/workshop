<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type_id' => 1,
                'name' => 'SPECIAL WATER CARRIER',
                'bn_name' => 'বিশেষ পানিবাহী',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 20:04:08',
                'updated_at' => '2021-09-13 20:04:08',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'type_id' => 1,
                'name' => 'WATER CARRIER',
                'bn_name' => 'পানিবাহী',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 20:05:27',
                'updated_at' => '2021-09-13 20:05:27',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'type_id' => 1,
                'name' => 'EMERGENCY TENDER',
                'bn_name' => 'ইমারজেন্সি টেন্ডার',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 20:07:23',
                'updated_at' => '2021-09-13 20:07:23',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'type_id' => 1,
                'name' => 'MINI RESCUE TENDER',
                'bn_name' => 'মিনি রেসকিউ টেন্ডার',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 20:08:40',
                'updated_at' => '2021-09-13 20:08:40',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'type_id' => 1,
                'name' => 'FOAM TENDER',
                'bn_name' => 'ফোম টেন্ডার',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 20:09:40',
                'updated_at' => '2021-09-13 20:09:40',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'type_id' => 1,
                'name' => 'PICKUP',
                'bn_name' => 'পিকাপ',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 20:11:21',
                'updated_at' => '2021-09-13 20:11:21',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'type_id' => 1,
                'name' => 'TRUCK',
                'bn_name' => 'ট্রাক',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 20:11:39',
                'updated_at' => '2021-09-13 20:11:39',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'type_id' => 1,
                'name' => 'TOWING',
                'bn_name' => 'টোয়িং',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 20:15:42',
                'updated_at' => '2021-09-13 20:29:03',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'type_id' => 1,
                'name' => 'AMBULANCE',
                'bn_name' => 'এ্যাম্বুলেন্স',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 20:16:58',
                'updated_at' => '2021-09-13 20:16:58',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'type_id' => 1,
                'name' => 'RESCUE FIRE COMMAND',
                'bn_name' => 'রেসকিউ ফায়ার কমান্ড',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 20:30:05',
                'updated_at' => '2021-09-13 20:30:05',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'type_id' => 1,
                'name' => 'CTV LIGHTING UNIT',
                'bn_name' => 'সিটিভি লাইটিং ইউনিট',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 20:31:03',
                'updated_at' => '2021-09-13 20:31:03',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'type_id' => 1,
                'name' => 'TWO WHEELER WATER MIST',
                'bn_name' => 'টু-হুইলার ওয়াটার মিস্ট',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 21:06:50',
                'updated_at' => '2021-09-13 21:06:50',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'type_id' => 3,
                'name' => 'INNER VALVE SPRING',
                'bn_name' => 'ইনার ভেলভ স্প্রিং',
                'status' => 'Inactive',
                'created_by' => 2,
                'updated_by' => 2,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 21:09:09',
                'updated_at' => '2021-09-14 15:10:59',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'type_id' => 1,
                'name' => 'MOTORCYCLE',
                'bn_name' => 'মটর সাইকেল',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-13 21:10:52',
                'updated_at' => '2021-09-13 21:10:52',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'type_id' => 2,
                'name' => 'POCKET PUMP',
                'bn_name' => 'পকেট পাম্প',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-14 14:19:04',
                'updated_at' => '2021-09-14 14:19:04',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'type_id' => 1,
                'name' => '1ST CALL WATER CARRIER',
                'bn_name' => '১ম কল পানিবাহী',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-14 14:20:34',
                'updated_at' => '2021-09-14 14:20:34',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'type_id' => 1,
                'name' => 'JEEP',
                'bn_name' => 'জীপ',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-14 14:36:19',
                'updated_at' => '2021-09-14 14:36:19',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'type_id' => 2,
                'name' => 'MEDIUM PUMP',
                'bn_name' => 'মিডিয়াম পাম্প',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-14 14:51:55',
                'updated_at' => '2021-09-14 14:51:55',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'type_id' => 3,
                'name' => 'GENERATOR',
                'bn_name' => 'জেনারটর',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-14 15:10:21',
                'updated_at' => '2021-09-14 15:10:21',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'type_id' => 1,
                'name' => '2ND CALL',
                'bn_name' => '২য় কল',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-14 15:31:13',
                'updated_at' => '2021-09-14 15:31:13',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'type_id' => 1,
                'name' => 'CARRYBOY',
                'bn_name' => 'ক্যারিবয়',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-14 15:32:48',
                'updated_at' => '2021-09-14 15:32:48',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'type_id' => 2,
                'name' => 'PORTABLE',
                'bn_name' => 'পোর্টেবল',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-14 15:34:49',
                'updated_at' => '2021-09-14 15:34:49',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'type_id' => 3,
                'name' => 'PORTABLE GENERATOR',
                'bn_name' => 'পোর্টেবল জেনারেটর',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-14 16:10:35',
                'updated_at' => '2021-09-14 16:10:35',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'type_id' => 3,
                'name' => 'ENGINE',
                'bn_name' => 'ইঞ্জিন',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-15 16:19:43',
                'updated_at' => '2021-09-15 16:19:43',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'type_id' => 1,
                'name' => 'CAP TYPE TOWING',
                'bn_name' => 'ক্যাপ টাইপ টোয়িং',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-15 19:11:33',
                'updated_at' => '2021-09-15 19:11:33',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'type_id' => 1,
                'name' => 'CHEMICAL TENDER',
                'bn_name' => 'ক্যামিকাল টেণ্ডার',
                'status' => 'Active',
                'created_by' => 2,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-09-20 16:26:32',
                'updated_at' => '2021-09-20 16:26:32',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}