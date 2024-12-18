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
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'image' => 'pizza.png',
            ],
            [
                'name' => 'Bánh ngọt',
                'slug' => 'cake',
                'image' => 'cake.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Salad',
                'slug' => 'salad',
                'image' => 'salad.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mỳ',
                'slug' => 'pasta',
                'image' => 'pasta.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nước ngọt',
                'slug' => 'soft',
                'image' => 'soft.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gà',
                'slug' => 'chicken',
                'image' => 'chicken.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Combo',
                'slug' => 'combo',
                'image' => 'combo.png',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
