<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            [
                'name' => 'Ví Momo',
                'description' => 'Thanh toán qua Momo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thanh toán khi giao hàng (COD)',
                'description' => 'Thanh toán khi nhận hàng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
