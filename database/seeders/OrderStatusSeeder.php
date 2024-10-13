<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\OrderStatus;
use Faker\Factory as Faker;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $statuses = [
            [
                'name' => 'Ch xác nhận',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Đã xác nhận',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Đang giao hàng',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Đã giao hàng',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Đã hủy',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        foreach ($statuses as $status) {
            OrderStatus::create($status);
        }
    }
}
