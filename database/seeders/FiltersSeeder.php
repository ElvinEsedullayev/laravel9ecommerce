<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsFilter;
class FiltersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productFilters = [
            ['id' => 1, 'cat_ids' => '1,2,3,6,7,8','filter_name' => 'Fabric', 'filter_column' => 'fabric', 'status' =>1],
            ['id' => 2, 'cat_ids' => '4,5','filter_name' => 'Ram', 'filter_column' => 'ram', 'status' =>1],
        ];
        ProductsFilter::insert($productFilters);
    }
}
