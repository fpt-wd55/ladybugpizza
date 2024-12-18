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
        $statuses = [
            [
                'name' => 'Chờ xác nhận',
                'slug' => 'waiting',
                'color' => 'yellow',
            ],
            [
                'name' => 'Đã xác nhận',
                'slug' => 'confirmed',
                'color' => 'blue',
            ],
            [
                'name' => 'Đang giao hàng',
                'slug' => 'shipping',
                'color' => 'gray',
            ],
            [
                'name' => 'Đã giao hàng',
                'slug' => 'delivered',
                'color' => 'purple',
            ],
            [
                'name' => 'Hoàn thành',
                'slug' => 'completed',
                'color' => 'green',
            ],
            [
                'name' => 'Đã hủy',
                'slug' => 'cancelled',
                'color' => 'red',
            ],
        ];

        foreach ($statuses as $status) {
            OrderStatus::create($status);
        }
    }
}
