<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $faker = Faker::create();

        $users = DB::table('users')->pluck('id')->toArray();
        $orders = DB::table('orders')->pluck('id')->toArray();
        $paymentMethods = DB::table('payment_methods')->pluck('id')->toArray();

        for ($i = 1; $i < 200; $i++) {
            Transaction::create([
                'order_id' => $faker->randomElement($orders),
                'user_id' => $faker->randomElement($users),
                'transaction_code' => $faker->uuid,
                'transaction_date' => $now,
                'payment_method_id' => $faker->randomElement($paymentMethods),
                'amount' => rand(100000, 1000000),
                'status' => rand(1, 2),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
