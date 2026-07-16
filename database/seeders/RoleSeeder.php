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
        'role_name' => 'admin',
        'description' => 'Administrator sistem',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'role_name' => 'user',
        'description' => 'User input barang',
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);
    }
}
