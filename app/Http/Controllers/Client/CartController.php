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
        // dd($cartItems);

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

        $cartItems = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->get();

        $attributes = Attribute::with('values')
            ->where('category_id', $product->category->id)
            ->where('status', 1)
            ->get();

        $checkProductQuantity = $this->checkProductQuantity($product, $validated);
        if ($checkProductQuantity !== true) {
            return back()->with('error', $checkProductQuantity['error']);
        }

        foreach ($cartItems as $cartItem) {
            $checkAttributes = $this->checkAttributes($cartItem, $validated, $attributes);
            $checkToppings = $this->checkToppings($cartItem, $validated);

            if ($checkAttributes && $checkToppings) {
                $totalQuantity = $cart->items->sum('quantity');
                if ($totalQuantity + $validated['quantity'] > 20) {
                    return back()->with('error', 'Bạn chỉ được thanh toán tối đa 20 sản phẩm!');
                }
                $cartItem->quantity += $validated['quantity'];
                $amount = $this->calculateItemPrice($product, $validated, $attributes);
                $cartItem->price += $amount;
                $cartItem->save();

                $cart->total = $cart->items->sum('price');
                $cart->save();

                return back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
            }
        }

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

        return true;
    }

    public function delete(CartItem $cartItem)
    {
        if ($cartItem->delete()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            $this->updateCart($cart);

            return redirect()->route('client.cart.index')->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công');
        }

        return redirect()->route('client.cart.index')->with('error', 'Xóa sản phẩm khỏi giỏ hàng thất bại');
    }

    private function calculateItemPrice($product, $validated, $attributes)
    {
        $priceProduct = $product->discount_price == 0 ? $product->price : $product->discount_price;
        $priceAttribute = 0;
        $priceTopping = 0;

        foreach ($attributes as $attribute) {
            $att = AttributeValue::find($validated['attributes_' . $attribute->slug]);
            $priceAttribute += ($att->price_type == 1) ? $att->price : $priceProduct * $att->price / 100;
        }

        if (isset($validated['toppings'])) {
            foreach ($validated['toppings'] as $topping) {
                $priceTopping += Topping::find($topping)->price;
            }
        }

        return ($priceProduct + $priceAttribute + $priceTopping) * $validated['quantity'];
    }

    public function updateCartItem(CartItem $cartItem)
    {
        $validatedData = request()->validate([
            'quantity' => 'required|integer|min:1',
        ], [
            'quantity.required' => 'Số lượng không được để trống',
            'quantity.integer' => 'Số lượng phải là một số nguyên',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 1',
        ]);

        if ($validatedData['quantity'] <= 0) {
            return redirect()->route('client.cart.index')->with('error', 'Số lượng sản phẩm phải lớn hơn 0');
        } else if ($validatedData['quantity'] > 20) {
            return redirect()->route('client.cart.index')->with('error', 'Bạn chỉ được thanh toán tối đa 20 sản phẩm');
        }

        $cartItem->quantity = $validatedData['quantity'];
        $cartItem->save();

        $cart = Cart::where('user_id', Auth::id())->first();
        $this->updateCart($cart);

        return redirect()->route('client.cart.index')->with('success', 'Cập nhật số lượng sản phẩm thành công');
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
            $priceProduct = $cartItem->product->discount_price == 0 ? $cartItem->product->price : $cartItem->product->discount_price;
            $priceAttribute = 0;
            $priceTopping = 0;

            if ($cartItem->attributeValues) {
                foreach ($cartItem->attributeValues as $attribute) {
                    $priceAttribute += ($attribute->price_type == 1) ? $attribute->price : $priceProduct * $attribute->price / 100;
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

    // Hàm kiểm tra số lượng sản phẩm trong kho
    private function checkProductQuantity($product, $validated)
    {
        if ($validated['quantity'] <= 0) {
            return ['error' => 'Số lượng sản phẩm phải lớn hơn 0'];
        } else if ($validated['quantity'] > 20) {
            return ['error' => 'Bạn chỉ được thanh toán tối đa 20 sản phẩm'];
        }

        if ($product->category->attributes->isNotEmpty()) {
            $attributes = $product->category->attributes;
            foreach ($attributes as $attribute) {
                $attributeValue = AttributeValue::find($validated['attributes_' . $attribute->slug]);
                if ($attributeValue->quantity <= 0) {
                    return ['error' => $attributeValue->value . ' đã hết hàng'];
                }
                if ($validated['quantity'] > $attributeValue->quantity) {
                    return ['error' => $attributeValue->value . ' chỉ còn ' . $attributeValue->quantity . ' sản phẩm'];
                }
            }
        } else {
            if ($product->quantity <= 0) {
                return ['error' => $product->name . ' đã hết hàng'];
            }
            if ($validated['quantity'] > $product->quantity) {
                return ['error' => $product->name . ' chỉ còn ' . $product->quantity . ' sản phẩm'];
            }
        }

        // Check topping
        if (isset($validated['toppings'])) {
            foreach ($validated['toppings'] as $topping) {
                $topping = Topping::find($topping);
                if ($topping->quantity != null && $topping->quantity <= 0) {
                    return ['error' => $topping->name . ' đã hết hàng'];
                }
                if ($topping->quantity != null && $validated['quantity'] > $topping->quantity) {
                    return ['error' => $topping->name . ' chỉ còn ' . $topping->quantity . ' sản phẩm'];
                }
            }
        }

        return true;
    }
}
