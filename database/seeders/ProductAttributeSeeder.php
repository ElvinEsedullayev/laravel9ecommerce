<?php

namespace Database\Seeders;

use App\Models\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributeSeeder = [
            ['id' => 1,'product_id' =>2,'size' => 'Small','price' => 1000, 'stock' => 10,'sku' => 'RN11-s','status' => 1],
            ['id' => 2,'product_id' =>2,'size' => 'Medium','price' => 1200, 'stock' => 15,'sku' => 'RN11-m','status' => 1],
        ];
        ProductAttribute::insert($productAttributeSeeder);
    }
}
