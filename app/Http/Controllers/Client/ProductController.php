<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Topping;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function menu(Request $request)
{
    $categories = Category::all();

    $search = $request->input('search');

    $categoryId = $request->input('category');

    $products = Product::when($categoryId, function ($query) use ($categoryId) {
        return $query->where('category_id', $categoryId);
    })
    ->when($search, function ($query) use ($search) {
        return $query->where('name', 'like', '%' . $search . '%');
    })->paginate(6);

    return view('clients.product.menu', compact('categories', 'products'));
}


    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        $attributes = $product->attributes()->get();

        $toppings = Topping::where('category_id', $product->category->id)->get();

        // dd($toppings);

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
