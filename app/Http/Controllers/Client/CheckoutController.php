<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemAttribute;
use App\Models\CartItemTopping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();

        foreach ($cartItems as $cartItem) {
            $cartItem->attributes = CartItemAttribute::where('cart_item_id', $cartItem->id)->get();
            $cartItem->toppings = CartItemTopping::where('cart_item_id', $cartItem->id)->get();
        }

        $addresses = Auth::user()->addresses;
        return view('clients.cart.checkout', [
            'cart' => $cart,
            'cartItems' => $cartItems,
            'addresses' => $addresses,
        ]);
    }

    public function postCheckout()
    {
        //
    }
}
