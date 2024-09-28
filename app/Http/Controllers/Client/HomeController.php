<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $listProHome = Product::where('is_featured',2)->select('image','name','avg_rating','quantity','description','price','discount_price')->limit(6)->get();
        return view('clients.home',['listProHome'=>$listProHome]);
    }
}
