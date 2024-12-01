<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Product;
use App\Models\Topping;
use App\Models\Favorite; 
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemAttribute;
use App\Models\CartItemTopping; 
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Hiển thị trang menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function menu()
    {
        $categories = Category::where('status', 1)
            ->where('id', '!=', 7)
            ->whereHas('products', function ($query) {
                $query->where('status', 1);
            })
            ->get();

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

        $evaluations = Evaluation::where('product_id', $product->id)->orderByDesc('created_at')->paginate(5);

        return view('clients.product.detail', [
            'product' => $product,
            'attributes' => $attributes,
            'toppings' => $toppings,
            'evaluations' => $evaluations,
            'favorites' => $favorites
        ]);
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
