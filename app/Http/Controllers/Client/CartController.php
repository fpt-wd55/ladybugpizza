<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)
        ->with('toppings')
        ->with('attributes')
        ->get();

        dd($cart);

        return view('clients.cart.index', [
            'cart' => $cart
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
