<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $orders = Order::get();

        foreach ($orders as $order) {
            Transaction::insert([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'transaction_code' => $order->payment_method_id == 1 ? 'MOMO_' . rand(1000, 9999) : 'COD_' . rand(1000, 9999),
                'transaction_date' => $now,
                'payment_method_id' => $order->payment_method_id,
                'amount' => rand(100000, 1000000),
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
