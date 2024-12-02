<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemAttribute;
use App\Models\CartItemTopping;
use App\Models\Product;
use App\Models\Topping;
use App\Models\User; 
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::where('category_id', 1)
            ->where('status', 1)
            ->get();

        foreach ($users as $user) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'total' => 0,
            ]);

            for ($i = 0; $i <= 3; $i++) {
                // Create a cart item
                $product = $products->random();
                $quantity = rand(1, 3);
                $cartItem = CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => 0,
                ]);
                $priceProduct = $product->price * $quantity;
                // Create a cart item attribute
                $attributes = AttributeValue::all();
                $priceAttribute = 0;
                for ($j = 0; $j < 2; $j++) {
                    $att = $attributes->random();
                    CartItemAttribute::create([
                        'cart_item_id' => $cartItem->id,
                        'attribute_value_id' => $att->id,
                    ]);
                    $priceAttribute += ($att->price_type == 1) ? $att->price : $product->price * $att->price / 100;
                }

                // Create a cart item topping
                $toppings = Topping::all();
                $priceTopping = 0;
                for ($j = 0; $j <= 3; $j++) {
                    $topping = $toppings->random();
                    CartItemTopping::create([
                        'cart_item_id' => $cartItem->id,
                        'topping_id' => $topping->id,
                    ]);
                    $priceTopping += $topping->price;
                }

                $cartItem->price = ($priceProduct + $priceAttribute + $priceTopping) * $quantity;
                $cartItem->save();
                $cart->total += $cartItem->price;
                $cart->save();
            }
        }
    }
}
