<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
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
