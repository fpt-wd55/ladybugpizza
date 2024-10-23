<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\CartItemTopping;
use App\Models\Topping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cartItems = CartItem::all();
        $toppings = Topping::all();

        $cartItemToppings = [
            [
                'cart_item_id' => $cartItems->random()->id,
                'topping_id' => $toppings->random()->id,
            ],
            [
                'cart_item_id' => $cartItems->random()->id,
                'topping_id' => $toppings->random()->id,
            ],
            [
                'cart_item_id' => $cartItems->random()->id,
                'topping_id' => $toppings->random()->id,
            ],
        ];

        CartItemTopping::insert($cartItemToppings);
    }
}
