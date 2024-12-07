<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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

        $orders = Order::where('order_status_id', 5)->pluck('id')->toArray();
        foreach ($orders as $order) { 
            Invoice::insert([
                'order_id' => $order,
                'invoice_number' => 'INV' . Str::random(5), 
                'created_at' => $now,
                'updated_at' => $now,
            ]); 
        }
    }
}
