<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\AttributeValue;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Topping;
use App\Models\User;
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
        $faker = Faker::create('vi_VN');
        $products = Product::all();
        $users = User::where('role_id', 2)->get();
        $paymentMethods = PaymentMethod::all();
        $orderStatuses = OrderStatus::all();
        $attributes = AttributeValue::all();
        $toppings = Topping::all();

        for ($i = 1; $i < 1500; $i++) {
            $user = $users->random();
            $address = Address::where('user_id', $user->id)->first();
            $order_status_id = $orderStatuses->random()->id;
            $created_at = $faker->dateTimeBetween('-1 year', 'now');
            $updated_at = $faker->dateTimeBetween($created_at->format('Y-m-d H:i:s'), 'now');
            Order::insert([
                'code' => 'LDB' . $faker->unique()->numberBetween(1000, 9999),
                'user_id' => $user->id,
                'fullname' => $user->fullname,
                'phone' => $user->phone,
                'email' => $user->email,
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
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
            for ($j = 1; $j < 5; $j++) {
                $orderItem = OrderItem::create([
                    'order_id' => $i,
                    'product_id' => $products->random()->id,
                    'quantity' => rand(1, 5),
                    'price' => rand(100, 500) * 1000,
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ]);
                for ($k = 1; $k < 3; $k++) {
                    DB::table('order_item_attributes')->insert([
                        'order_item_id' => $orderItem->id,
                        'attribute_value_id' => $attributes->random()->id,
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ]);
                    DB::table('order_item_toppings')->insert([
                        'order_item_id' => $orderItem->id,
                        'topping_id' => $toppings->random()->id,
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ]);
                }
            }
        }

        $timeLimit = now()->subDay();
        $orders = Order::where('order_status_id', 4)
            ->where('updated_at', '<=', $timeLimit)
            ->get();

        foreach ($orders as $order) {
            // Cập nhật trạng thái đơn hàng
            $order->order_status_id = 5;
            $order->completed_at = now();
            $order->save();

            // Tạo hóa đơn
            $dataInvoice = [
                'order_id' => $order->id,
                'invoice_number' => 'INV' . now()->format('Ymd') . '-' . $order->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            Invoice::create($dataInvoice); 
        }
    }
}
