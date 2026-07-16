<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'role_name' => 'Admin',
                'description' => 'Administrator Sistem',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_name' => 'Petugas',
                'description' => 'Petugas Gudang',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
