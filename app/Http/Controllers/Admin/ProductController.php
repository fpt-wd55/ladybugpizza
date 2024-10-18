<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Evaluation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('admins.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admins.product.add', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = trim(strtolower($request->sku)) . '_' . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $image->getClientOriginalExtension();
        }

        // Xử lý số lượng sản phẩm
        if ($request->category_id) {
            $category = Category::find($request->category_id);
            $quantity = $category->attributes->count() > 0 ? 0 : $request->quantity;
        }

        // Dữ liệu
        $data = [
            'name' => trim($request->name),
            'slug' => trim(strtolower($request->sku)) . '-' . Str::slug($request->name),
            'image' => $image_name,
            'description' => trim($request->description),
            'category_id' => trim($request->category_id),
            'price' => $request->price,
            'discount_price' => $request->discount_price ?? 0,
            'quantity' => $quantity,
            'sku' => trim(strtoupper($request->sku)),
            'status' => isset($request->status) ? $request->status : 2,
            'is_featured' => isset($request->is_featured) ? $request->is_featured : 2,
            'avg_rating' => 0,
            'total_rating' => 0,
        ];

        // Lưu vào database
        if (Product::create($data)) {
            // Xử lý lưu ảnh
            $image->storeAs('public/uploads/products', $image_name);
            // Thông báo
            return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm sản phẩm thất bại');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->get();
        return view('admins.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // Xử lý ảnh
        $old_image = $product->image;
        $image_name = $old_image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = trim(strtolower($request->sku)) . '_' . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $image->getClientOriginalExtension();
        }

        // Xử lý số lượng sản phẩm
        if ($request->category_id) {
            $category = Category::find($request->category_id);
            $quantity = $category->attributes->count() > 0 ? 0 : $request->quantity;
        }

        // Dữ liệu
        $data = [
            'name' => trim($request->name),
            'slug' => trim(strtolower($request->sku)) . '-' . Str::slug($request->name),
            'image' => $image_name,
            'description' => trim($request->description),
            'category_id' => trim($request->category_id),
            'price' => $request->price,
            'discount_price' => $request->discount_price ?? 0,
            'quantity' => $quantity,
            'sku' => trim(strtoupper($request->sku)),
            'status' => isset($request->status) ? $request->status : 2,
            'is_featured' => isset($request->is_featured) ? $request->is_featured : 2,
            'avg_rating' => 0,
            'total_rating' => 0,
        ];

        // Lưu vào database
        if ($product->update($data)) {
            // Xử lý lưu ảnh
            if ($request->hasFile('image')) {
                $image->storeAs('public/uploads/products', $image_name);
                // Kiểm tra tồn tại ảnh cũ 
                if (file_exists(storage_path('app/public/uploads/products/' . $old_image))) {
                    unlink(storage_path('app/public/uploads/products/' . $old_image));
                }
            }
            // Thông báo
            return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật sản phẩm thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa sản phẩm thất bại');
        }
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trash()
    {
        $products = Product::onlyTrashed()->orderBy('id', 'desc')->paginate(10);
        return view('admins.product.trash', compact('products'));
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);

        if ($product->restore()) {
            return redirect()->back()->with('success', 'Khôi phục sản phẩm thành công');
        }

        return redirect()->back()->with('error', 'Khôi phục sản phẩm thất bại');
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->find($id);

        if ($product) {
            // Kiểm tra tồn tại ảnh sản phẩm
            if (file_exists(storage_path('app/public/uploads/products/' . $product->image))) {
                unlink(storage_path('app/public/uploads/products/' . $product->image));
            }
            $product->forceDelete();
            return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
        }

        return redirect()->back()->with('error', 'Xóa sản phẩm thất bại');
    }
   // phần Đánh Giá
    public function listComment(String $id)
    {
        $sanpham = Product::query()->findOrFail($id);
        $evaluations = Evaluation::where('product_id',$id)->paginate(10);
        return view('admins.evaluations.edit',compact('sanpham','evaluations'));
    }
}
