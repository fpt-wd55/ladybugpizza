<?php

namespace App\Http\Middleware;

use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\CartItem;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCartQuantity
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng của bạn trống');
        }

        $cartItems = CartItem::where('cart_id', $cart->id)->get();

        foreach ($cartItems as $item) {
            if ($item->product->status == 2 || $item->product->delete_at != null || $item->product->category->deleted_at != null) {
                return redirect()->route('client.cart.index')->with('error', $item->product->name . ' đã ngừng kinh doanh');
            }
        }

        $totalQuantity = $cart->items()->sum('quantity');

        if ($totalQuantity > 20) {
            return redirect()->route('client.cart.index')->with('error', 'Bạn chỉ được thanh toán tối đa 20 sản phẩm trong một đơn hàng');
        }

        foreach ($cartItems as $item) {
            $product = $item->product;
            if ($product->category->attributes->isNotEmpty()) {
                $attributes = $product->category->attributes;
                foreach ($attributes as $attribute) {
                    $attributeValues = $item->attributeValues;
                    foreach ($attributeValues as $attributeValue) {
                        if ($attributeValue->quantity <= 0) {
                            return redirect()->route('client.cart.index')->with('error', $product->name . ' - ' . $attributeValue->value . ' đã hết hàng');
                        }
                        if ($item->quantity > $attributeValue->quantity) {
                            return redirect()->route('client.cart.index')->with('error', $product->name . ' - ' . $attributeValue->value . ' chỉ còn ' . $attributeValue->quantity . ' sản phẩm');
                        }
                    }
                }
            } else {
                if ($product->quantity != null && $product->quantity <= 0) {
                    return redirect()->route('client.cart.index')->with('error', $product->name . ' đã hết hàng');
                }
                if ($product->quantity != null && $item->quantity > $product->quantity) {
                    return redirect()->route('client.cart.index')->with('error', $product->name . ' chỉ còn ' . $product->quantity . ' sản phẩm');
                }
            }

            // Check topping
            if ($item->toppings->isNotEmpty()) {
                foreach ($item->toppings as $topping) {
                    if ($topping->quantity != null && $topping->quantity <= 0) {
                        return redirect()->route('client.cart.index')->with('error', $product->name . ' - ' . $topping->name . ' đã hết hàng');
                    }
                    if ($topping->quantity != null && $item->quantity > $topping->quantity) {
                        return redirect()->route('client.cart.index')->with('error', $product->name . ' - ' . $topping->name . ' chỉ còn ' . $topping->quantity . ' sản phẩm');
                    }
                }
            }
        }

        return $next($request);
    }
}
