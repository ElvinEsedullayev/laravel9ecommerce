<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandSeeder = [
            ['id' => 1,'status' => 1, 'name' => 'Arrow'],
            ['id' => 2,'status' => 1, 'name' => 'Gap'],
            ['id' => 3,'status' => 1, 'name' => 'Lee'],
            ['id' => 4,'status' => 1, 'name' => 'Samsung'],
            ['id' => 5,'status' => 1, 'name' => 'LG'],
            ['id' => 6,'status' => 1, 'name' => 'Lenova'],
            ['id' => 7,'status' => 1, 'name' => 'Mi'],
        ];
        Brand::insert($brandSeeder);
    }
}
