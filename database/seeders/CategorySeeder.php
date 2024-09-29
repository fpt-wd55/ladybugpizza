<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
        $now = Carbon::now();

        DB::table('categories')->insert([
            [
                'name' => 'Pizza',
                'slug' => 'pizza',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Bánh ngọt',
                'slug' => 'banh-ngot',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Salad',
                'slug' => 'salad',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Mỳ',
                'slug' => 'my',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Nước ngọt',
                'slug' => 'nuoc-ngot',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Gà',
                'slug' => 'ga',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Combo',
                'slug' => 'combo',
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
