<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function menu()
    {
        $categories = Category::all();

        $products = [];

        foreach ($categories as $category) {
            $products[$category->name] = $category->products()->paginate(6); // Phân trang cho sản phẩm trong danh mục
        }

        return view('clients.product.menu', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function show()
    {
        return view('clients.product.show');
    }

    public function addToCart()
    {
    }
}
