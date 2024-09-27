<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = DB::table('users')->pluck('id')->toArray();
        $addresses = DB::table('addresses')->pluck('id')->toArray();
        $paymentMethods = DB::table('payment_methods')->pluck('id')->toArray();
        $orderStatuses = DB::table('order_statuses')->pluck('id')->toArray();
        $productAttributes = DB::table('product_attributes')->pluck('id')->toArray();
        $toppings = DB::table('toppings')->pluck('id')->toArray();

        for ($i = 1; $i < 200; $i++) {
            DB::table('orders')->insert([
                'user_id' => $faker->randomElement($users),
                'promotion_id' => null,
                'amount' => $faker->numberBetween(100000, 1000000),
                'address_id' => $faker->randomElement($addresses),
                'discount_amount' => $faker->numberBetween(0, 10000),
                'shipping_fee' => 25000,
                'completed_at' => $faker->dateTimeThisYear(),
                'notes' => $faker->text,
                'payment_method_id' => $faker->randomElement($paymentMethods),
                'order_status_id' => $faker->randomElement($orderStatuses),
                'canceled_reason' => $faker->text,
                'canceled_at' => $faker->dateTimeThisYear(),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);

            DB::table('order_items')->insert([
                'order_id' => $i,
                'quantity' => $faker->numberBetween(1, 10),
                'price' => $faker->numberBetween(10000, 100000),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);

            DB::table('order_item_attributes')->insert([
                'order_item_id' => $i,
                'product_attribute_id' => $faker->randomElement($productAttributes),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);

            DB::table('order_item_toppings')->insert([
                'order_item_id' => $i,
                'topping_id' => $faker->randomElement($toppings),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}
