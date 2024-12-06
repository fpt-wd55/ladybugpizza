<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemAttribute;
use App\Models\CartItemTopping;
use App\Models\Product;
use App\Models\Topping;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()],
            ['user_id' => Auth::id()]
        );

        // Cập nhật lại giỏ hàng khi có sự thay đổi (giá, số lượng, ...)
        $this->updateCart($cart);

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

    public function addToCart(AddToCartRequest $request, Product $product)
    {
        $validated = $request->validated();
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        if (!$cart) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
        }

        // Kiem tra xem san pham da co trong gio hang chua 
        $cartItems = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->get();

        $attributes = Attribute::with('values')
            ->where('category_id', $product->category->id)
            ->where('status', 1)
            ->get();

        foreach ($cartItems as $cartItem) {
            $checkAttributes = $this->checkAttributes($cartItem, $validated, $attributes);
            $checkToppings = $this->checkToppings($cartItem, $validated);

            if ($checkAttributes && $checkToppings) {
                // Cập nhật số lượng và giá nếu tìm thấy CartItem phù hợp
                $cartItem->quantity += $validated['quantity'];
                $amount = $this->calculateItemPrice($product, $validated, $attributes);
                $cartItem->price += $amount;
                $cartItem->save();

                $cart->total = $cart->items->sum('price');
                $cart->save();

                return back()->with('success', 'Cập nhật sản phẩm trong giỏ hàng thành công!');
            }
        }

        // Thêm sản phẩm vào CartItem
        $cartItem = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'price' => 0,
            'quantity' => $validated['quantity'],
        ]);
        // Thêm attribute vào CartItemAttribute
        foreach ($attributes as $attribute) {
            CartItemAttribute::create([
                'cart_item_id' => $cartItem->id,
                'attribute_value_id' => $validated['attributes_' . $attribute->slug],
            ]);
        }
        // Thêm topping vào CartItemTopping
        if (isset($validated['toppings'])) {
            foreach ($validated['toppings'] as $topping) {
                CartItemTopping::create([
                    'cart_item_id' => $cartItem->id,
                    'topping_id' => $topping,
                ]);
            }
        }

        // Cập nhật giá của CartItem
        $amount = $this->calculateItemPrice($product, $validated, $attributes);
        $cartItem->price = $amount;
        $cartItem->save();
        // Cập nhật giá trị total của Cart
        $cart->total = $cart->items->sum('price');
        $cart->save();

        return back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
    }

    private function calculateItemPrice($product, $validated, $attributes)
    {
        $priceProduct = $product->price;
        $priceAttribute = 0;
        $priceTopping = 0;

        foreach ($attributes as $attribute) {
            $att = AttributeValue::find($validated['attributes_' . $attribute->slug]);
            $priceAttribute += ($att->price_type == 1) ? $att->price : $product->price * $att->price / 100;
        }

        if (isset($validated['toppings'])) {
            foreach ($validated['toppings'] as $topping) {
                $priceTopping += Topping::find($topping)->price;
            }
        }

        return ($priceProduct + $priceAttribute + $priceTopping) * $validated['quantity'];
    }

    private function checkAttributes($cartItem, $validated, $attributes)
    {
        foreach ($attributes as $attribute) {
            $cartItemAttribute = CartItemAttribute::where('cart_item_id', $cartItem->id)
                ->where('attribute_value_id', $validated['attributes_' . $attribute->slug])
                ->first();
            if (!$cartItemAttribute) {
                return false;
            }
        }
        return true;
    }

    private function checkToppings($cartItem, $validated)
    {
        // Nếu không có topping nào được gửi, nhưng sản phẩm trước đó cũng không có topping -> hợp lệ
        if (!isset($validated['toppings']) || empty($validated['toppings'])) {
            $existingToppings = CartItemTopping::where('cart_item_id', $cartItem->id)->count();
            return $existingToppings === 0;
        }

        // Nếu có topping được gửi, kiểm tra từng topping
        foreach ($validated['toppings'] as $topping) {
            $cartItemTopping = CartItemTopping::where('cart_item_id', $cartItem->id)
                ->where('topping_id', $topping)
                ->first();
            if (!$cartItemTopping) {
                return false; // Có topping không khớp
            }
        }

        // Kiểm tra nếu sản phẩm trước đó có topping nhưng lần này không gửi topping
        $existingToppings = CartItemTopping::where('cart_item_id', $cartItem->id)->pluck('topping_id')->toArray();
        if (count($existingToppings) !== count($validated['toppings'])) {
            return false; // Số lượng topping không khớp
        }

        return true; // Tất cả topping khớp
    }

    public function delete(CartItem $cartItem)
    {
        if ($cartItem->delete()) {
            $cart = Cart::find(Auth::id());
            $this->updateCart($cart);

            return redirect()->route('client.cart.index')->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công');
        }

        return redirect()->route('client.cart.index')->with('error', 'Xóa sản phẩm khỏi giỏ hàng thất bại');
    }

    public function updateCart($cart)
    {
        $cartItems = CartItem::where('cart_id', $cart->id)->get();

        if ($cartItems->isEmpty()) {
            return;
        }

        // Xóa sản phẩm đã ngừng bán
        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);
            if ($product->status != 1) {
                $cartItem->delete();
            }
        }

        foreach ($cartItems as $cartItem) {
            $priceProduct = $cartItem->product->price;
            $priceAttribute = 0;
            $priceTopping = 0;

            if ($cartItem->attributes) {
                foreach ($cartItem->attributes as $attribute) {
                    $att = AttributeValue::find($attribute->attribute_value_id);
                    $priceAttribute += ($att->price_type == 1) ? $att->price : $cartItem->product->price * $att->price / 100;
                }
            }

            if ($cartItem->toppings) {
                foreach ($cartItem->toppings as $topping) {
                    $priceTopping += Topping::find($topping->topping_id)->price;
                }
            }

            $cartItem->price = ($priceProduct + $priceAttribute + $priceTopping) * $cartItem->quantity;
            $cartItem->save();
        }

        $cart->total = $cart->items->sum('price');
        $cart->save();
    }
}
