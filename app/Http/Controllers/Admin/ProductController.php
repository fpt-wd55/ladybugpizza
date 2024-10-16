<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
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
            $image_name = time() . '_' . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $image->getClientOriginalExtension();
        }
        // Dữ liệu
        $data = [
            'name' => $request->name,
            'slug' => $request->sku . '-' . Str::slug($request->name),
            'image' => $image_name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'quantity' => $request->quantity,
            'sku' => $request->sku,
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
            return redirect()->route('admin.prouducs.index')->with('success', 'Thêm sản phẩm thành công');
        } else {
            return redirect()->back()->with('error', 'Thêm sản phẩm thất bại');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admins.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Display a listing of the trashed resources.
     */
    public function trash() {}

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        //
    }

    /**
     * Force delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        //
    }
}
