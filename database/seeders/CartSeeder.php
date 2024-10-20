<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\ProductAttribute;
use App\Models\Topping;
use App\Models\User;
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
        $users = User::pluck('id')->toArray();
        $productAttributes = ProductAttribute::pluck('id')->toArray();
        $toppings = Topping::pluck('id')->toArray();

        for ($i = 1; $i < 100; $i++) {
            Cart::insert([
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
