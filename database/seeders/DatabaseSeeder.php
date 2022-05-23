<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(AdminSeeder::class);
        //$this->call(VendorSeeder::class);
        //$this->call(VendorBusinessDetailSeeder::class);
        //$this->call(VendorBankDetailSeeder::class);
        //$this->call(SectionSeeder::class);
        //$this->call(CategorySeeder::class);
        //$this->call(BrandSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
