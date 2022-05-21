<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;
class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorSeeder = [
            'id' => 1,
            'name' => 'Elvin Asadullayev',
            'address' => '18 microregion',
            'city' => 'Sumgait',
            'state' => 'Baku',
            'country' => 'Azerbaijan',
            'pincode' => '123456',
            'mobile' => '0512267283',
            'email' => 'elvin@gmail.com',
            'status' => 0
        ];
        Vendor::insert($vendorSeeder);
    }
}
