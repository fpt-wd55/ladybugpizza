<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\OrderStatus;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

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
                'name' => 'Chờ xác nhận',
                'slug' => 'waiting',
                'color' => 'yellow',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Đã xác nhận',
                'slug' => 'confirmed',
                'color' => 'blue',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Đang giao hàng',
                'slug' => 'shipping',
                'color' => 'gray',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Hoàn thành',
                'slug' => 'completed',
                'color' => 'green',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Đã hủy',
                'slug' => 'cancelled',
                'color' => 'red',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($statuses as $status) {
            OrderStatus::create($status);
        }
    }
}
