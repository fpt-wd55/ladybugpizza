<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\AttributeValue;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Product;
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
        $products = Product::all();
        $users = User::where('role_id', 2)->get();
        $paymentMethods = PaymentMethod::all();
        $orderStatuses = OrderStatus::all();
        $attributes = AttributeValue::all();
        $toppings = Topping::all();

        for ($i = 1; $i < 500; $i++) {
            $user = $users->random()->id;
            $address = Address::where('user_id', $user)->first();
            $order_status_id = $orderStatuses->random()->id;
            Order::insert([
                'code' => 'LDB' . $faker->unique()->numberBetween(1000, 9999),
                'user_id' => $user,
                'fullname' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'promotion_id' => null,
                'amount' => rand(100, 700) * 1000,
                'address_id' => $address->id,
                'discount_amount' => rand(0, 10000),
                'shipping_fee' => 30000,
                'completed_at' => $order_status_id == 5 ? $faker->dateTimeBetween('-1 year', 'now') : null,
                'notes' => $faker->text,
                'payment_method_id' => $paymentMethods->random()->id,
                'order_status_id' => $order_status_id,
                'canceled_at' => $order_status_id == 6 ? $faker->dateTimeBetween('-1 year', 'now') : null,
                'cancelled_reason' => $order_status_id == 6 ? $faker->text : null,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' =>  $faker->dateTimeBetween('-1 year', 'now'),
            ]);
            for ($j = 1; $j < 5; $j++) {
                $orderItem = OrderItem::create([
                    'order_id' => $i,
                    'product_id' => $products->random()->id,
                    'quantity' => rand(1, 5),
                    'price' => rand(100, 500) * 1000,
                ]);
                for ($k = 1; $k < 3; $k++) {
                    DB::table('order_item_attributes')->insert([
                        'order_item_id' => $orderItem->id,
                        'attribute_value_id' => $attributes->random()->id,
                    ]);
                    DB::table('order_item_toppings')->insert([
                        'order_item_id' => $orderItem->id,
                        'topping_id' => $toppings->random()->id,
                    ]);
                }
            }
        }
    }
}
