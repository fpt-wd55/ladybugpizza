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
        }
    }
}
