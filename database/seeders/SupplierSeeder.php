<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::insert([
            [
                'supplier_name' => 'Kelompok Tani Makmur',
                'phone' => '081234567890',
                'email' => 'makmur@example.com',
                'address' => 'Padang, Sumatera Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_name' => 'CV Agri Nusantara',
                'phone' => '082345678901',
                'email' => 'agrinusantara@example.com',
                'address' => 'Bukittinggi, Sumatera Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_name' => 'Koperasi Tani Sejahtera',
                'phone' => '083456789012',
                'email' => 'sejahtera@example.com',
                'address' => 'Payakumbuh, Sumatera Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
