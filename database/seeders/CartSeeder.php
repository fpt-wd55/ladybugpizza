<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = DB::table('users')->pluck('id')->toArray();
        $productAttributes = DB::table('product_attributes')->pluck('id')->toArray();
        $toppings = DB::table('toppings')->pluck('id')->toArray();

        for ($i = 1; $i < 200; $i++) {
            DB::table('carts')->insert([
                'user_id' => $faker->randomElement($users),
                'quantity' => $faker->numberBetween(1, 10),
                'price' => $faker->numberBetween(10000, 100000),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);

            DB::table('cart_attributes')->insert([
                'cart_id' => $i,
                'product_attribute_id' => $faker->randomElement($productAttributes),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);

            DB::table('cart_toppings')->insert([
                'cart_id' => $i,
                'topping_id' => $faker->randomElement($toppings),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}
