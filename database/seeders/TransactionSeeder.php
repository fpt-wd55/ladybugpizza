<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = DB::table('users')->pluck('id')->toArray();
        $orders = DB::table('orders')->pluck('id')->toArray();
        $paymentMethods = DB::table('payment_methods')->pluck('id')->toArray();

        for ($i = 1; $i < 200; $i++) {
            DB::table('transactions')->insert([
                'order_id' => $faker->randomElement($orders),
                'user_id' => $faker->randomElement($users),
                'transaction_code' => $faker->uuid,
                'transaction_date' => $faker->dateTimeThisYear(),
                'payment_method_id' => $faker->randomElement($paymentMethods),
                'amount' => $faker->numberBetween(100000, 1000000),
                'status' => $faker->numberBetween(1, 2),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}
