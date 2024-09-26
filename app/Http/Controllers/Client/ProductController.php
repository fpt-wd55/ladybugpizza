<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('clients.product.menu');
    }

    public function show()
    {
        return view('clients.product.show');
    }

    public function addToCart()
    {
    }
}
