<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorBankDetail;
class VendorBankDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBankDetail = [
            'id' => 1,
            'vendor_id' => 1,
            'account_holder_name' => 'Elvin',
            'account_number' => '146793123',
            'bank_name' => 'Bizim Bank',
            'bank_ifsc_code' => '749873111',
            'created_at' => now(),
            'updated_at' => now()
        ];
        VendorBankDetail::insert($vendorBankDetail);
    }
}
