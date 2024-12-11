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
                'name' => 'Pizza',
                'slug' => 'pizza',
                'is_resettable' => true,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'pizza.png',
            ],
            [
                'name' => 'Bánh ngọt',
                'slug' => 'cake',
                'is_resettable' => true,
                'image' => 'cake.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Salad',
                'slug' => 'salad',
                'is_resettable' => true,
                'image' => 'salad.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mỳ',
                'slug' => 'pasta',
                'is_resettable' => true,
                'image' => 'pasta.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nước ngọt',
                'slug' => 'soft',
                'is_resettable' => false,
                'image' => 'soft.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gà',
                'slug' => 'chicken',
                'is_resettable' => true,
                'image' => 'chicken.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Combo',
                'slug' => 'combo',
                'is_resettable' => false,
                'image' => 'combo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
