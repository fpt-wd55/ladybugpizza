<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\CartItem;
use App\Models\CartItemAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cartItems = CartItem::all();

        $attributes = AttributeValue::all();

        $cartItemAttributes = [
            [
                'cart_item_id' => $cartItems->random()->id,
                'attribute_value_id' => $attributes->random()->id,
            ],
            [
                'cart_item_id' => $cartItems->random()->id,
                'attribute_value_id' => $attributes->random()->id,
            ],
            [
                'cart_item_id' => $cartItems->random()->id,
                'attribute_value_id' => $attributes->random()->id,
            ],
        ];

        CartItemAttribute::insert($cartItemAttributes);
    }
}
