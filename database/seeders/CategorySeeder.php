<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('categories')->insert([
            [
                'name' => 'Bánh ngọt',
                'slug' => 'banh-ngot',
                'image' => 'banh-ngot.jpg',
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'name' => 'Salad',
                'slug' => 'salad',
                'image' => 'salad.jpg',
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'name' => 'Pizza',
                'slug' => 'pizza',
                'image' => 'pizza.jpg',
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'name' => 'Mỳ',
                'slug' => 'my',
                'image' => 'my.jpg',
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'name' => 'Nước ngọt',
                'slug' => 'nuoc-ngot',
                'image' => 'nuoc-ngot.jpg',
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'name' => 'Gà',
                'slug' => 'ga',
                'image' => 'ga.jpg',
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ],
            [
                'name' => 'Combo',
                'slug' => 'combo',
                'image' => 'combo.jpg',
                'status' => 1,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]
        ]);
    }
}
