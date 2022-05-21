<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorySeeder = [
            [
                'id' => 1,
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'Men',
                'category_image' => '',
                'category_discount' => 0,
                'description' => '',
                'url' => 'Men',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => 1
            ],
            [
                'id' => 2,
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'Women',
                'category_image' => '',
                'category_discount' => 0,
                'description' => '',
                'url' => 'Women',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => 1
            ],
            [
                'id' => 3,
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'Kids',
                'category_image' => '',
                'category_discount' => 0,
                'description' => '',
                'url' => 'Kids',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => 1
            ],
        ];
        Category::insert($categorySeeder);
    }
}
