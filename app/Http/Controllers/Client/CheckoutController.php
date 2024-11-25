<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemAttribute;
use App\Models\CartItemTopping;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAttribute;
use App\Models\OrderItemTopping;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();

        foreach ($cartItems as $cartItem) {
            $cartItem->attributes = CartItemAttribute::where('cart_item_id', $cartItem->id)->get();
            $cartItem->toppings = CartItemTopping::where('cart_item_id', $cartItem->id)->get();
        }

        $addresses = Auth::user()->addresses;
        $paymentMethods = PaymentMethod::all();
        return view('clients.cart.checkout', [
            'cart' => $cart,
            'cartItems' => $cartItems,
            'addresses' => $addresses,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function postCheckout(CheckoutRequest $request)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();

        foreach ($cartItems as $cartItem) {
            $cartItem->attributes = CartItemAttribute::where('cart_item_id', $cartItem->id)->get();
            $cartItem->toppings = CartItemTopping::where('cart_item_id', $cartItem->id)->get();
        }

        // Check address_id
        if ($request->old_address == -1 && !$request->address_id) {
            $address = Address::created([
                'user_id' => Auth::id(),
                'title' => 'Địa chỉ' . Auth::user()->addresses->count() + 1,
                'province' => $request->province,
                'district' => $request->district,
                'ward' => $request->ward,
                'detail_address' => $request->detail_address,
                'is_default' => 0,
            ]);
        }

        $data = [
            'user_id' => Auth::id(),
            'promotion_id' => session('promotion') ? session('promotion')['id'] : null,
            'amount' => $cart->total,
            'address_id' => $address->id ?? $request->old_address,
            'order_status_id' => 1,
            'discount_amount' => session('promotion') ? session('promotion')['discount'] : 0,
            'shipping_fee' => 30000,
            'notes' => $request->notes ?? null,
            'payment_method_id' => $request->payment_method_id,
            'canceled_at' => null,
            'canceled_reason' => null,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        $order = Order::create($data);
        if ($order) {
            foreach ($cartItems as $cartItem) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                ]);

                if ($cartItem->attributes) {
                    foreach ($cartItem->attributes as $attribute) {
                        OrderItemAttribute::create([
                            'order_item_id' => $orderItem->id,
                            'attribute_value_id' => $attribute->attribute_value_id,
                        ]);
                    }
                }

                if ($cartItem->toppings) {
                    foreach ($cartItem->toppings as $topping) {
                        OrderItemTopping::create([
                            'order_item_id' => $orderItem->id,
                            'topping_id' => $topping->topping_id,
                        ]);
                    }
                }
            }

            $cart->delete();
            session()->forget('promotion');
            return redirect()->route('client.order.index')->with('success', 'Đặt hàng thành công');
        } else {
            return redirect()->back()->with('error', 'Đặt hàng thất bại');
        }
    }
}
