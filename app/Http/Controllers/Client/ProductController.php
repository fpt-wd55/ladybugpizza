<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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

        $combos = Product::where('category_id', 7)->where('status', 1)->get();

        $products = [];

        $products = Product::where('status', 1)
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
    public function addToCart(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'total' => 0,
                'total_discount' => 0,
            ]);
        }

        $data = $request->all();

        // dd($data);

        $attributes = data_get($data, 'attributes', []);
        $toppings = data_get($data, 'toppings', []);

        $attributePrice = 0;
        $toppingPrice = 0;

        foreach ($attributes as $attribute) {
            $attributePrice += AttributeValue::find($attribute)->price($product);
        }

        foreach ($toppings as $topping) {
            $toppingPrice += Topping::find($topping)->price;
        }

        $price = $product->price + $attributePrice + $toppingPrice;
        $discountPrice = $product->discount_price + $attributePrice + $toppingPrice;

        $cartItem = [
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'price' => $price,
            'discount_price' => $discountPrice,
            'quantity' => $data['quantity'],
            'amount' => $price * $data['quantity'],
        ];

        if (!CartItem::create($cartItem)) {

            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau!');
        }

        return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');




        // $cartItem = CartItem::where('carg_id', $cart->id())->first();

        // dd($cartItem);


    }

    /**
     * Xoá một list sản phẩm khỏi giỏ hàng (có thể áp dụng cho việc xoá một sản phẩm cụ thể và clear giỏ hàng)
     * 
     * @return void
     */
    public function removeFromCart()
    {
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
