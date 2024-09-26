<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        DB::table('categories')->insert([
            [
                'name' => 'Bánh ngọt',
                'slug' => 'banh-ngot',
                'image' => 'banh-ngot.jpg',
                'status' => 1,
            ],
            [
                'name' => 'Salad',
                'slug' => 'salad',
                'image' => 'salad.jpg',
                'status' => 1,
            ],
            [
                'name' => 'Pizza',
                'slug' => 'pizza',
                'image' => 'pizza.jpg',
                'status' => 1,
            ],
            [
                'name' => 'Mỳ',
                'slug' => 'my',
                'image' => 'my.jpg',
                'status' => 1,
            ],
            [
                'name' => 'Nước ngọt',
                'slug' => 'nuoc-ngot',
                'image' => 'nuoc-ngot.jpg',
                'status' => 1,
            ],
            [
                'name' => 'Gà',
                'slug' => 'ga',
                'image' => 'ga.jpg',
                'status' => 1,
            ],
            [
                'name' => 'Combo',
                'slug' => 'combo',
                'image' => 'combo.jpg',
                'status' => 1,
            ]
        ]);
    }
}
