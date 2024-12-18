<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\OpeningHour;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;

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

        $now = Str::lower(Carbon::now()->dayName);
        $todayOpeningHour = OpeningHour::where('day_of_week', $now)->first();

        return view('clients.home', [
            'products' => $products,
            'banners' => $banners,
            'todayOpeningHour' => $todayOpeningHour,
        ]);
    }
}
