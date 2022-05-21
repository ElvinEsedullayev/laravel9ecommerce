<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminSeeder = [
            'id' => 2,
            'name' => 'Admin',
            'type' => 'admin',
            'vendor_id' => 1,
            'mobile' => '0557512552',
            'email' => 'elvin@gmail.com',
            'image' => '',
            'status' => 0,
            'password' => Hash::make(12345678)
        ];

        Admin::insert($adminSeeder);
    }
}
