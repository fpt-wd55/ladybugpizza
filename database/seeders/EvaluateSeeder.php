<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class EvaluateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $products = DB::table('products')->pluck('id')->toArray();
        $users = DB::table('users')->pluck('id')->toArray();

        foreach ($products as $product) {
            for ($i = 0; $i < 10; $i++) {
                $user = $faker->randomElement($users);
                DB::table('evaluates')->insert([
                    'user_id' => $user,
                    'product_id' => $product,
                    'rating' => $faker->numberBetween(1, 5),
                    'comment' => $faker->sentence,
                    'status' => 1,
                    'created_at' => $faker->dateTimeThisYear(),
                    'updated_at' => $faker->dateTimeThisYear(),
                ]);
            }
        }
    }
}
