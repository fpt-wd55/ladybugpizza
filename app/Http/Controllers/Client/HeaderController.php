<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Favorite;
use App\Models\Order;
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
        // check user login
        if (!Auth::check()) {
            return compact('pages');
        } else {
            // Số lượng sản phẩm yêu thích
            $favorites = Favorite::where('user_id', Auth::id())->count();
            $countFavorites = $favorites;
            // Số lượng sản phẩm trong giỏ hàng
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart !== null) {
                $cartItems = CartItem::where('cart_id', $cart->id)->get();
            } else {
                $cartItems = collect();
            }
            $countCartItems = $cartItems->count();
            $countOrders = Order::where('user_id', Auth::id())
            ->whereNotIn('order_status_id', [5, 6])
            ->count();
            return compact('pages', 'countFavorites', 'countCartItems', 'countOrders');
        }
    }
}
