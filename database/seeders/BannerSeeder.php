<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerSeeder = [
            ['id' => 1, 'title' => 'Spring Collection', 'alt' => 'Spring Collection', 'image' => 'banner-1.png', 'link' => 'spring-collection', 'status' =>1],
            ['id' => 2, 'title' => 'Tops', 'alt' => 'Tops', 'image' => 'banner-2.png', 'link' => 'tops', 'status' =>1]
        ];
        Banner::insert($bannerSeeder);
    }
}
