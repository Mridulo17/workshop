<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductPartsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_parts')->delete();
        
        \DB::table('product_parts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Brake Shoe',
                'bn_name' => 'ব্রেক শু',
                'brand_id' => 3,
                'model_id' => 5,
                'unit_id' => 1,
                'sku' => 'KSDFJFDJ71GHK12GK',
                'material' => 'রাবার',
                'material_type' => 'parts',
                'parts' => 'specific',
                'image' => 'uploads/images/product_part_image/backgroud_wordshop_5411973.jpg',
                'weight' => 1.0,
                'scrapable' => '1',
                'stock_check' => '1',
                'minimum_stock' => 0,
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2021-07-29 17:49:13',
                'updated_at' => '2021-08-18 09:48:45',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'TEST',
                'bn_name' => 'টেস্ট',
                'brand_id' => 2,
                'model_id' => 4,
                'unit_id' => 1,
                'sku' => 'KSDFJFDJ71GHK1৩',
                'material' => 'Cillum voluptatibus',
                'material_type' => 'liquids',
                'parts' => 'specific',
                'image' => 'C:\\xampp\\tmp\\phpA1F4.tmp',
                'weight' => 70.0,
                'scrapable' => '1',
                'stock_check' => '1',
                'minimum_stock' => 0,
                'status' => 'Active',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'created_at' => '2021-08-18 10:54:42',
                'updated_at' => '2021-08-18 10:54:42',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}