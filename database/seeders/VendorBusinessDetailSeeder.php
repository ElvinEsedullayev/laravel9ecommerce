<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorBusinessDetail;
class VendorBusinessDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBusinessDetail = [
            'id' => 1,
            'vendor_id' => 1,
            'shop_name' => 'bikerstore',
            'shop_address' => '9 micro region',
            'shop_city' => 'sumgait',
            'shop_state' => 'baku',
            'shop_country' => 'azerbaijan',
            'shop_pincode' => '012201222',
            'shop_mobile' => '0186565555',
            'shop_website' => 'bikerstore.com',
            'shop_email' => 'bikerstoere@gmail.com',
            'address_proof' => '00012755',
            'address_proof_image' => 'test',
            'businecc_license_number' => '001100452',
            'gst_number' => '146545',
            'pon_number' => '487532',
            'created_at' => now(),
            'updated_at' => now()

        ];
        VendorBusinessDetail::insert($vendorBusinessDetail);
    }
}
