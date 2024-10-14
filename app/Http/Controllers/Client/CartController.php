<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart;
        return view('clients.cart.index');
    }

    public function checkout()
    {
        return view('clients.cart.checkout');
    }

    public function postCheckout()
    {
    }
}
