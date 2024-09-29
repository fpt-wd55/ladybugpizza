<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Promotion;
use App\Models\User;
use App\Models\PromotionUser;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::pluck('id')->toArray(); // Lấy ID của tất cả người dùng

        for ($i = 0; $i < 10; $i++) {
            $code = $faker->unique()->word;
            $description = $faker->sentence;
            $discount_type = $faker->randomElement(['percent', 'fixed']);
            $discount_value = $discount_type == 'percent' ? rand(1, 100) : rand(50000, 100000);
            $start_date = $faker->dateTimeBetween('-1 month', 'now');
            $end_date = $faker->dateTimeBetween('now', '+1 month');
            $quantity = rand(1, 100);
            $min_order_total = rand(100000, 500000);
            $max_discount = rand(100000, 500000);
            $is_global = 2;
            $status = 1;

            $now = Carbon::now();

            // Tạo mới một khuyến mãi
            $promotion = Promotion::create([
                'code' => $code,
                'description' => $description,
                'discount_type' => $discount_type,
                'discount_value' => $discount_value,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'quantity' => $quantity,
                'min_order_total' => $min_order_total,
                'max_discount' => $max_discount,
                'is_global' => $is_global,
                'status' => $status,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($users as $user) {
                // Tạo mới bản ghi liên kết giữa khuyến mãi và người dùng
                PromotionUser::create([
                    'promotion_id' => $promotion->id, // Sử dụng ID của khuyến mãi đã tạo
                    'user_id' => $user,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
