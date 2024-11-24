<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Product;
use App\Models\Topping;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemAttribute;
use App\Models\CartItemTopping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Hiển thị trang menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function menu()
    {
        $categories = Category::all();

        $products = [];

        $products = Product::where('status', 1)
            ->get();

            $combos = Product::where('category_id', 7)
            ->where('status', 1) 
            ->orderByDesc('is_featured')
            ->get();

        return view('clients.product.menu', [
            'categories' => $categories,
            'products' => $products,
            'combos' => $combos
        ]);
    }

    /**
     * Hiển thị trang chi tiết sản phẩm
     * @param mixed $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        $attributes = Attribute::with('values')
            ->where('category_id', $product->category->id)
            ->where('status', 1)
            ->get();

        $favorites = Favorite::where('user_id', Auth::id())->pluck('product_id');

        $toppings = Topping::where('category_id', $product->category->id)->get();

        $evaluations = Evaluation::where('product_id', $product->id)->get();

        $evaluations->each(function ($evaluation) {
            $evaluation->user = User::find($evaluation->user_id);
        });

        return view('clients.product.detail', [
            'product' => $product,
            'attributes' => $attributes,
            'toppings' => $toppings,
            'evaluations' => $evaluations,
            'favorites' => $favorites
        ]);
    }

    /**
     * Thêm mới một sản phẩm vào giở hàng
     */
    public function addToCart(AddToCartRequest $request, Product $product)
    {
        $validated = $request->validated();
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            // Thêm sản phẩm vào CartItem
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'price' => 0,
                'quantity' => $validated['quantity'],
            ]);

            if (!$cartItem) {
                return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
            }

            // Thêm thuộc tính vào CartItemAttribute
            $attributes = Attribute::with('values')
                ->where('category_id', $product->category->id)
                ->where('status', 1)
                ->get();
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

            $priceProduct = $product->price * $validated['quantity'];
            $priceAttribute = 0;
            foreach ($attributes as $attribute) {
                $att = AttributeValue::find($validated['attributes_' . $attribute->slug]);
                if ($att->price_type == 1) {
                    $priceAttribute += $att->price;
                } else {
                    $priceAttribute += $product->price * $att->price / 100;
                }
            }
            $priceTopping = 0;
            if (isset($validated['toppings'])) {
                foreach ($validated['toppings'] as $topping) {
                    $priceTopping += Topping::find($topping)->price;
                }
            }
            $amount = $priceProduct + $priceAttribute + $priceTopping;

            // Cập nhật giá của CartItem
            $cartItem->price = $amount;
            $cartItem->save();
            // Cập nhật giá trị total của Cart
            $cart->total += $amount;
            $cart->save();

            return back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
        }

        return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
    } 

    /**
     * Lấy ra danh sách các sản phẩm yêu thích của người dùng đang đăng nhập
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function favorites()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('product')
            ->get();

        return view('partials.clients', [
            'favorites' => $favorites
        ]);
    }

    /**
     * Thêm mới sản phẩm vào danh sách yêu thích
     * @param mixed $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postFavorite($slug)
    {
        $product = Product::where('slug', $slug)->first();

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào yêu thích!');
        }

        if ($product) {
            // Kiểm tra xem sản phẩm đã có trong yêu thích chưa
            $favorite = Favorite::where('user_id', Auth::id())->where('product_id', $product->id)->first();

            if ($favorite) {
                // Nếu đã tồn tại, xóa khỏi danh sách yêu thích
                $favorite->delete();
                return back()->with('success', 'Sản phẩm đã được xóa khỏi danh sách yêu thích!');
            } else {
                // Nếu chưa tồn tại, thêm vào danh sách yêu thích
                Favorite::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                ]);
                return back()->with('success', 'Sản phẩm đã được thêm vào danh sách yêu thích!');
            }
        }

        return back()->with('error', 'Sản phẩm không tồn tại!');
    } 
}
