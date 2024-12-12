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

        if (!$cart) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng của bạn trống.');
        }

        $totalQuantity = $cart->items()->sum('quantity');

        if ($totalQuantity >= 20) {
            return redirect()->route('client.cart.index')->with('error', 'Số lượng sản phẩm trong giỏ hàng không được vượt quá 20.');
        }

        return $next($request);
    }
}
