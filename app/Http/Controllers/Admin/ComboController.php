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
use App\Models\Evaluation;
use App\Models\EvaluationImage;

class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $combos = Product::orderByDesc('id')->where('category_id', 7)->paginate(10);

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

            return redirect()->route('admin.combos.index')->with('success', 'Thêm combo thành công');
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
    public function destroy(Product $combo)
    {
        if ($combo->delete()) {
            return redirect()->back()->with('success', 'Xóa combo thành công');
        } else {
            return redirect()->back()->with('error', 'Xóa combo thất bại');
        }
    }
    public function trashCombo(){
        $categories = Category::where('status', 1)->get();
        $combos = Product::onlyTrashed()->where('category_id', 7)->orderBy('id', 'desc')->paginate(10);
        return view('admins.combo.trash', compact('combos', 'categories'));
    }

    public function restoreCombo($id) {
        $combo = Product::withTrashed()->find($id);

        if ($combo->restore()) {
            return redirect()->back()->with('success', 'Khôi phục combo thành công');
        }

        return redirect()->back()->with('error', 'Khôi phục combo thất bại');
    }

    public function forceDelete($id) {
        $combo = Product::withTrashed()->find($id);

        if ($combo) {
            if (file_exists(storage_path('app/public/uploads/combos/' . $combo->image))) {
                unlink(storage_path('app/public/uploads/combos/' . $combo->image));
            }
            $combo->forceDelete();
            return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
        }

        return redirect()->back()->with('error', 'Xóa sản phẩm thất bại');
    }

    public function bulkAction(Request $request)
    {
        $selectedIds = explode(',', $request->input('selected_ids'));
        $action = $request->input('action');

        if ($action == 'delete') {
            Product::whereIn('id', $selectedIds)->delete();
            return redirect()->back()->with('success', 'Xóa combo thành công');
        } else if ($action == 'force_delete') {
            foreach ($selectedIds as $id) {
                $forceCombo = Product::withTrashed()->find($id);
                $old_image = $forceCombo->image;
                if ($forceCombo) {
                    if ($forceCombo->image != null) {
                        try {
                            if (file_exists(storage_path('app/public/uploads/combos/' . $old_image))) {
                                unlink(storage_path('app/public/uploads/combos/' . $old_image));
                            }
                        } catch (\Exception $e) {
                            return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
                        }
                    }
                    $forceCombo->forceDelete();
                } else {
                    return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
                }
            }
            return redirect()->back()->with('success', 'Xóa vĩnh viễn combo thành công');
        } else if ($action == 'restore') {
            Product::withTrashed()->whereIn('id', $selectedIds)->restore();
            return redirect()->back()->with('success', 'Khôi phục combo thành công');
        }

        return redirect()->back()->with('error', 'Đã có lỗi xảy ra');
    }

    public function search(Request $request){
    $combos = Product::orderBy('id', 'desc')
        ->where('category_id', 7)
        ->where('name', 'like', '%' . $request->search . '%')
        ->orWhere('sku', 'like', '%' . $request->search . '%')
        ->paginate(10);

    $combos->appends(['search' => $request->search]);

    return view('admins.combo.trash', compact('combos'));
    }

    public function evaluation(Product $combo)
    {
        $evaluations = Evaluation::where('product_id', $combo->id)->with('order')->paginate(10);

        foreach ($evaluations as $evaluation) {
            $evaluation->images = EvaluationImage::where('evaluation_id', $evaluation->id)->get();
        }

        return view('admins.combo.evaluation', compact('combo', 'evaluations'));
    }

    public function evaluationUpdate(Request $request, Evaluation $evaluation)
    {
        if ($evaluation) {
            $evaluation->update([
                'status' => $request->status ? 1 : 2,
            ]);
            return redirect()->back()->with('success', 'Cập nhật đánh giá thành công');
        }
        return redirect()->back()->with('error', 'Cập nhật đánh giá thất bại');
    }

}
