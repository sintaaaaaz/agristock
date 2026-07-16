<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'category_name' => 'Sayuran',
                'description' => 'Hasil Pertanian berupa Sayuran',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'Buah',
                'description' => 'Hasil Pertanian berupa Buah-buahan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'umbi-umbian',
                'description' => 'Hasil Pertanian berupa Umbi-umbian',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'Biji-bijian',
                'description' => 'Hasil Pertanian berupa Biji-bijian',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'Rempah-rempah',
                'description' => 'Hasil Pertanian berupa Rempah-rempah',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
