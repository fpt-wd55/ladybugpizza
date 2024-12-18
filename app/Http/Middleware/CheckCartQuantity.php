<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCartQuantity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $cart = Cart::find(Auth::id());
        $cartItems = $cart->items;

        foreach ($cartItems as $item) {
            if ($item->product->status == 2 || $item->product->delete_at != null || $item->product->category->deleted_at != null) {
                return redirect()->route('client.cart.index')->with('error', 'Sản phẩm ' . $item->product->name . ' đã ngừng kinh doanh');
            }
        }

        foreach ($cartItems as $item) {
            if ($item->product->quantity != null && $item->quantity > $item->product->quantity) {
                return redirect()->route('client.cart.index')->with('error', 'Sản phẩm ' . $item->product->name . ' chỉ còn ' . $item->product->quantity . ' sản phẩm');
            }
        }

        foreach ($cartItems as $item) {
            $product = $item->product;
            if (!is_null($product->quantity) && $product->quantity <= 0) {
                return redirect()
                    ->route('client.cart.index')
                    ->with('error', $product->name . ' đã hết hàng');
            }
        }

        if (!$cart) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng của bạn trống');
        }

        $totalQuantity = $cart->items()->sum('quantity');

        if ($totalQuantity > 20) {
            return redirect()->route('client.cart.index')->with('error', 'Bạn chỉ được thanh toán tối đa 20 sản phẩm trong một đơn hàng');
        }

        return $next($request);
    }
}
