<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemAttribute;
use App\Models\CartItemTopping;
use App\Models\Product;
use App\Models\Topping;
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
        $products = Product::all();

        foreach ($carts as $cart) {
            for ($i = 0; $i <= 3; $i++) {
                // Create a cart item

                $product = $products->random();
                $quantity = rand(1, 5);
                $cartItem = CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price * $quantity,
                ]);

                // Create a cart item attribute
                $attributes = AttributeValue::all();
                for ($j = 0; $j < 3; $j++) {
                    CartItemAttribute::create([
                        'cart_item_id' => $cartItem->id,
                        'attribute_value_id' => $attributes->random()->id,
                    ]);
                }

                // Create a cart item topping
                $toppings = Topping::all();
                for ($j = 0; $j <= 3; $j++) {
                    CartItemTopping::create([
                        'cart_item_id' => $cartItem->id,
                        'topping_id' => $toppings->random()->id,
                    ]);
                }
            }
        }
    }
}
