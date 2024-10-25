<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('client.home')->with('error', 'Bạn cần đăng nhập để truy cập trang này');
        }

        $cart = Cart::where('user_id', $user->id)->first();



        $cartItems = CartItem::where('cart_id', $cart->id)
            ->with('toppings')
            ->with('attributes')
            ->get();

            // dd($cartItems);

        return view('clients.cart.index', [
            'cartItems' => $cartItems
        ]);
    }
    public function checkout()
    {
        return view('clients.cart.checkout');
    }

    public function postCheckout()
    {
    }
}
