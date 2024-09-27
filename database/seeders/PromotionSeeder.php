<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // php artisan make:seeder PromotionSeeder
        // php artisan make:seeder PromotionUserSeeder
        $faker = Faker::create();
        $users = DB::table('users')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) { 
            $code = $faker->unique()->word;
            $description = $faker->sentence;
            $discount_type = $faker->randomElement(['percent', 'fixed']);
            $discount_value = $discount_type == 'percent' ? $faker->numberBetween(1, 100) : $faker->numberBetween(50000, 100000);
            $start_date = $faker->dateTimeBetween('-1 month', 'now');
            $end_date = $faker->dateTimeBetween('now', '+1 month');
            $quantity = $faker->numberBetween(1, 100);
            $min_order_total = $faker->numberBetween(100000, 500000);
            $max_discount = $faker->numberBetween(100000, 500000);
            $is_global = 2;
            $status = 1;
            $created_at = now();
            $updated_at = now();

            $promotion = DB::table('promotions')->insert([
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
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);

            foreach ($users as $user) {
                DB::table('promotion_users')->insert([
                    'promotion_id' => $promotion,
                    'user_id' => $user,
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ]);
            }
        }
    }
}  