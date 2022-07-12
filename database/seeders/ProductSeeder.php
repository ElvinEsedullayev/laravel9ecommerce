<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productSeeder = [
            [
                'id' =>  1,
                'section_id' => 7,
                'category_id' => 4,
                'brand_id' => 7,
                'vendor_id' => 1,
                'admin_id' =>0,
                'admin_type' => 'vendor',
                'product_name' => "Redmi Note 11",
                'product_code' => 'RN11',
                'product_color' => 'Blue',
                'product_price' => '355',
                'product_discount' => 10,
                'product_weight' => 500,
                'product_image' => '',
                'product_video' => '',
                'description' => '',
                'meta_title' => '',
                'meta_description' => '', 
                'meta_keywords' => '',
                'is_featured' => 'Yes',
                'is_bestseller' => 'Yes',
                'status' => 1
            ],
             [
                'id' =>  2,
                'section_id' => 1,
                'category_id' => 8,
                'brand_id' => 2,
                'vendor_id' => 0,
                'admin_id' =>1,
                'admin_type' => 'superadmin',
                'product_name' => "Red Casual T-shirt",
                'product_code' => 'RC021',
                'product_color' => 'Red',
                'product_price' => '15',
                'product_discount' => 20,
                'product_weight' => 200,
                'product_image' => '',
                'product_video' => '',
                'description' => '',
                'meta_title' => '',
                'meta_description' => '', 
                'meta_keywords' => '',
                'is_featured' => 'Yes',
                'is_bestseller' => 'Yes',
                'status' => 1
            ],
          
        ];
        Product::insert($productSeeder);
    }
}
