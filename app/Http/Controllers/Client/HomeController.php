<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\OpeningHour;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_featured', 1)
            ->where('category_id', 1)
            ->where('status', 1)
            ->limit(6)
            ->get();

        $banners = Banner::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clients.home', [
            'products' => $products,
            'banners' => $banners,
        ]);
    }
}
