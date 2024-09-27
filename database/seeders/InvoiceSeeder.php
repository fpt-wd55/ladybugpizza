<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $orders = DB::table('orders')->pluck('id')->where('order_status_id', 4)->toArray();
        
        foreach ($orders as $order) {
            $transaction = DB::table('transactions')->pluck('id')->where('order_id', $order)->toArray();
            DB::table('invoices')->insert([
                'order_id' => $order,
                'invoice_number' => $faker->uuid,
                'transaction_id' => $transaction[0],
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }
         
    }
} 