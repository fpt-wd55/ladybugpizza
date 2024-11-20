<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemAttribute;
use App\Models\CartItemTopping;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('client.home')->with('error', 'Bạn cần đăng nhập để truy cập trang này');
        }

        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();

        foreach ($cartItems as $cartItem) {
            $cartItem->attributes = CartItemAttribute::where('cart_item_id', $cartItem->id)->get();
            $cartItem->toppings = CartItemTopping::where('cart_item_id', $cartItem->id)->get();
        }

        return view('clients.cart.index', [
            'cart' => $cart,
            'cartItems' => $cartItems,
        ]);
    }

    public function delete(CartItem $cartItem)
    { 

        if(!$cartItem->delete()) {
            return redirect()->route('client.cart.index')->with('error', 'Xóa sản phẩm khỏi giỏ hàng thất bại');
        }
        
        return redirect()->route('client.cart.index')->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công');
    }

    public function checkout()
    {
        return view('clients.cart.checkout');
    }

    public function postCheckout() {}
}
