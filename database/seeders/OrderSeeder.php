<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\ProductAttribute;
use App\Models\Topping;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $faker = Faker::create();
        $users = User::get()->pluck('id')->toArray();
        $addresses = Address::get()->pluck('id')->toArray();
        $paymentMethods = PaymentMethod::get()->pluck('id')->toArray();
        $orderStatuses = OrderStatus::get()->pluck('id')->toArray();
        $productAttributes = ProductAttribute::get()->pluck('id')->toArray();
        $toppings = Topping::get()->pluck('id')->toArray();

        for ($i = 1; $i < 200; $i++) {
            Order::insert([
                'user_id' => $faker->randomElement($users),
                'promotion_id' => null,
                'amount' => rand(100000, 1000000),
                'address_id' => $faker->randomElement($addresses),
                'discount_amount' => rand(0, 10000),
                'shipping_fee' => 25000,
                'completed_at' => $now,
                'notes' => $faker->text,
                'payment_method_id' => $faker->randomElement($paymentMethods),
                'order_status_id' => $faker->randomElement($orderStatuses),
                'canceled_reason' => $faker->text,
                'canceled_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            OrderItem::insert([
                'order_id' => $i,
                'quantity' => rand(1, 10),
                'price' => rand(10000, 100000),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            for ($j = 1; $j < 5; $j++) {
                DB::table('order_item_attributes')->insert([
                    'order_item_id' => $i,
                    'product_attribute_id' => $faker->randomElement($productAttributes),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
                DB::table('order_item_toppings')->insert([
                    'order_item_id' => $i,
                    'topping_id' => $faker->randomElement($toppings),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
