<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Topping;
use App\Models\Favorite;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;

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

        $attributes = Attribute::with('values')
        ->where('category_id', $product->category->id)
        ->where('status', 1)
        ->get();

        // dd($attributes);

        $favorites = Favorite::where('user_id', Auth::id())->pluck('product_id');

        $toppings = Topping::where('category_id', $product->category->id)->get();

        return view('clients.product.detail', [
            'product' => $product,
            'attributes' => $attributes,
            'toppings' => $toppings,
            'favorites' => $favorites
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
    public function postFavorite($slug)
    {
        $product = Product::where('slug', $slug)->first();

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào yêu thích!');
        }

        if ($product) {
            // Kiểm tra xem sản phẩm đã có trong yêu thích chưa
            if (!Favorite::where('user_id', Auth::id())->where('product_id', $product->id)->exists()) {
                Favorite::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                ]);
            }

            return back()->with('success', 'Sản phẩm đã được thêm vào yêu thích!');
        }

        return back()->with('error', 'Sản phẩm không tồn tại!');
    }

}
