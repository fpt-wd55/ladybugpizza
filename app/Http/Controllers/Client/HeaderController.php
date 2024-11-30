<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeaderController extends Controller
{
    public static function showFavorites()
    {
        $favorites = Favorite::where('user_id', Auth::id())->with('product')->get();
        return compact('favorites');
    }

    public static function getHeaderData()
    {
        $pages = Page::where('status', 1)->get();
        return compact('pages');
    }
}
