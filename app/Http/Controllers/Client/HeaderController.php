<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Favorite;
use App\Models\Page;
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
        // Danh sách các trang
        $pages = Page::where('status', 1)->get();
        // Số lượng sản phẩm yêu thích
        $favorites = Favorite::where('user_id', Auth::id())->count();
        $countFavorites = $favorites;
        // Số lượng sản phẩm trong giỏ hàng
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $countCartItems = $cartItems->count();
        return compact('pages', 'countFavorites', 'countCartItems');
    }
}
