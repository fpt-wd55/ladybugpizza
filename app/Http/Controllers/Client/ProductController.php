<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Product;
use App\Models\Topping;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\User;

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
        
        $evaluations = Evaluation::where('product_id', $product->id)->get();

        $evaluations->each(function ($evaluation) {
            $evaluation->user = User::find($evaluation->user_id);
        });

        return view('clients.product.detail', [
            'product' => $product,
            'attributes' => $attributes,
            'toppings' => $toppings,
            'evaluations'=> $evaluations
        ]);
    }

    public function addToCart()
    {
    }
    public function favorites()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('product')
            ->get();
        return view('partials.clients', compact('favorites'));
    }
}
