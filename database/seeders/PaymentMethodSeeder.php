<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;
use Carbon\Carbon;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        PaymentMethod::insert([
            [
                'name' => 'Thanh toán online qua ví MoMo',
                'description' => 'Thanh toán online qua ví MoMo',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Thanh toán online qua VNPAY',
                'description' => 'Thanh toán online qua VNPAY',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Thanh toán khi giao hàng (COD)',
                'description' => 'Thanh toán khi giao hàng (COD)',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
