<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Str;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $orders = Order::where('order_status_id', 4)->pluck('id')->toArray();

        foreach ($orders as $order) {
            $transaction = Transaction::where('order_id', $order)->pluck('id')->toArray();

            if (!empty($transaction)) {
                Invoice::create([
                    'order_id' => $order,
                    'invoice_number' => Str::random(10),
                    'transaction_id' => $transaction[0],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
