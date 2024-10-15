<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Topping;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function menu()
    {
        $categories = Category::all();

        $combos = Product::where('category_id', 7)->where('status', 1)->get();

        $products = [];

        $products = Product::where('status', 1)
            ->get();

        return view('clients.product.menu', [
            'categories' => $categories,
            'products' => $products,
            'combos' => $combos
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        $attributes = $product->attributes()->get();

        $toppings = Topping::where('category_id', $product->category->id)->get();

        return view('clients.product.detail', [
            'product' => $product,
            'attributes' => $attributes,
            'toppings' => $toppings
        ]);
    }

    public function addToCart()
    {
    }
}
