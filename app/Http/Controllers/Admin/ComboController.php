<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComboRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $combos = Product::where('category_id', 7)->paginate(10);

        return view('admins.combo.index', compact('combos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pizzas = Product::where('category_id', 1)->get();
        $bases = AttributeValue::where('attribute_id', 1)->get();
        $sizes = AttributeValue::where('attribute_id', 2)->get();
        $sauces = AttributeValue::where('attribute_id',3)->get();
        $toppings = Topping::all();
        $categories = Category::whereNotIn('id', [1,7])->with('products')->get();
        return view('admins.combo.create', [
            'pizzas' => $pizzas,
            'bases' => $bases,
            'sizes' => $sizes,
            'sauces' => $sauces,
            'toppings' => $toppings,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComboRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = trim(strtolower($request->sku)) . '_' . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $image->getClientOriginalExtension();
        }

        $data = [
            'name' => trim($request->name),
            'slug' => trim(strtolower($request->sku)) . '-' . Str::slug($request->name),
            'image' => $image_name,
            'description' => trim($request->description),
            'category_id' => 7,
            'price' => $request->price,
            'discount_price' => $request->discount_price ?? 0,
            'quantity' => $request->quantity,
            'sku' => trim(strtoupper($request->sku)),
            'status' => isset($request->status) ? $request->status : 2,
            'is_featured' => isset($request->is_featured) ? $request->is_featured : 2,
            'avg_rating' => 0,
            'total_rating' => 0,
        ];
        // dd($data);

        if (Product::create($data)) {
            $image->storeAs('public/uploads/combos', $image_name);

            return redirect()->route('admins.combo')->with('success', 'Thêm combo thành công');
        } else {

            return redirect()->back()->with('error', 'Thêm combo thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $combo)
    {
        $pizzas = Product::where('category_id', 1)->get();
        $bases = AttributeValue::where('attribute_id', 1)->get();
        $sizes = AttributeValue::where('attribute_id', 2)->get();
        $sauces = AttributeValue::where('attribute_id',3)->get();
        $toppings = Topping::all();
        $categories = Category::whereNotIn('id', [1,7])->with('products')->get();
        return view('admins.combo.edit', [
            'combo' => $combo,
            'pizzas' => $pizzas,
            'bases' => $bases,
            'sizes' => $sizes,
            'sauces' => $sauces,
            'toppings' => $toppings,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComboRequest $request, Product $combo)
    {
        $old_image = $combo->image;
        $image_name = $old_image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = trim(strtolower($request->sku)) . '_' . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $image->getClientOriginalExtension();
        }

        $data = [
            'name' => trim($request->name),
            'slug' => trim(strtolower($request->sku)) . '-' . Str::slug($request->name),
            'image' => $image_name,
            'description' => trim($request->description),
            'category_id' => 7,
            'price' => $request->price,
            'discount_price' => $request->discount_price ?? 0,
            'quantity' => $request->quantity,
            'sku' => trim(strtoupper($request->sku)),
            'status' => isset($request->status) ? $request->status : 2,
            'is_featured' => isset($request->is_featured) ? $request->is_featured : 2,
            'avg_rating' => 0,
            'total_rating' => 0,
        ];

        if ($combo->update($data)) {
            if ($request->hasFile('image')) {
                $image->storeAs('public/uploads/combos', $image_name);
                if (file_exists(storage_path('app/public/uploads/combos/' . $old_image))) {
                    unlink(storage_path('app/public/uploads/combos/' . $old_image));
                }
            }

            return redirect()->back()->with('success', 'Cập nhật combo thành công');
        } else {

            return redirect()->back()->with('error', 'Cập nhật combo thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function trashCombo(){

    }

    public function restoreCombo() {

    }

    public function deleteCombo() {

    }

    public function forceDelete() {

    }
}
