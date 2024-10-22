<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts = Cart::all();

        $items = [
            [
                'cart_id' => $carts->random()->id,
                'price' => rand(100, 500) * 1000,
                'discount_price' => rand(100, 500) * 1000,
                'quantity' => rand(1, 5),
                'amount' => rand(100, 500) * 1000,
            ],
            [
                'cart_id' => $carts->random()->id,
                'price' => rand(100, 500) * 1000,
                'discount_price' => rand(100, 500) * 1000,
                'quantity' => rand(1, 5),
                'amount' => rand(100, 500) * 1000,
            ],
            [
                'cart_id' => $carts->random()->id,
                'price' => rand(100, 500) * 1000,
                'discount_price' => rand(100, 500) * 1000,
                'quantity' => rand(1, 5),
                'amount' => rand(100, 500) * 1000,
            ]
        ];

        CartItem::insert($items);
    }
}
