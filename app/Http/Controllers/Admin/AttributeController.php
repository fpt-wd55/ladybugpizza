<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::paginate(5);
        return view('admins.attribute.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admins.attribute.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            "attribute_name" => "required",
            "category_id" => "required",
            "stocks.*" => "required"
        ];

        foreach ($request->stocks as $key => $value) {
            $rules["stocks.{$key}.attribute_value"] = 'required';
            $rules["stocks.{$key}.attribute_quantity"] = 'nullable|numeric';
        }

        $messages = [
            'attribute_name.required' => 'Vui lòng nhập tên thuộc tính',
            'category_id.required' => 'Vui lòng chọn danh mục',
            'stocks.*.required' => 'Vui lòng nhập giá trị thuộc tính cho sản phẩm',
            'stocks.*.attribute_value.required' => 'Vui lòng nhập giá trị thuộc tính cho sản phẩm',
            'stocks.*.attribute_quantity.numeric' => 'Giá trị không hợp lệ',
        ];

        $request->validate($rules, $messages);

        $attribute = Attribute::create(
            [
                "name" => $request->attribute_name,
                "category_id" => $request->category_id,
                "status" => !isset($request->status) ? 2 : $request->status
            ]
        );

        if (!$attribute) {
            return redirect()->back()->with(['error' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
        foreach ($request->stocks as $key => $value) {
            AttributeValue::create([
                'attribute_id' => $attribute->id,
                'value' => $value['attribute_value'],
                'quantity' => $value['attribute_quantity'] ?? null,
            ]);
        }
        return redirect()->route('admin.attributes.index')->with(['success' => 'Thêm thuộc tính thành công']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        $categories = Category::all();
        return view('admins.attribute.edit', compact('attribute', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        $rules = [
            "attribute_name" => "required",
            "category_id" => "required", 
        ];

        if ($request->stocks) {
            foreach ($request->stocks as $key => $value) {
                $rules["stocks.{$key}.attribute_value"] = 'required';
                $rules["stocks.{$key}.attribute_quantity"] = 'nullable|numeric';
            }
        }

        if ($request->old_stocks) {
            foreach ($request->old_stocks as $key => $value) {
                $rules["old_stocks.{$key}.value"] = 'required';
                $rules["old_stocks.{$key}.quantity"] = 'nullable|numeric';
            }
        }

        $messages = [
            'attribute_name.required' => 'Vui lòng nhập tên thuộc tính',
            'stocks.*.attribute_value.required' => 'Vui lòng nhập giá trị thuộc tính',
            'stocks.*.attribute_quantity.numeric' => 'Giá trị không hợp lệ',
            'old_stocks.*.value.required' => 'Vui lòng nhập giá trị thuộc tính',
            'old_stocks.*.quantity.numeric' => 'Giá trị không hợp lệ',
        ];

        $request->validate($rules, $messages);

        $attribute->update(
            [
                "name" => $request->attribute_name,
                "category_id" => $request->category_id,
                "status" => !isset($request->status) ? 2 : $request->status
            ]
        );

        if (!$attribute) {
            return redirect()->back()->with(['error' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }

        $attributeValues = AttributeValue::where('attribute_id', $attribute->id)->get()->toArray();
        $oldStocks = $request->old_stocks;
        $newStocks = $request->stocks;

        foreach ($oldStocks as $oldStock) {
            $oldStock['id'] = array_search($oldStock, $attributeValues);
        }

        // So sanh do dai voi so luong phan tu cua mang cu va moi, neu khac nhau thi xoa phan tu cu
        if (count($attributeValues) != count($oldStocks)) {
            // so sanh value['id'] cua mang cu va moi, neu khac nhau thi xoa phan tu cu
            foreach ($attributeValues as $attributeValue) {
                if (!in_array($attributeValue['id'], array_column($oldStocks, 'id'))) {
                    AttributeValue::find($attributeValue['id'])->delete();
                }
            }
        } else {
            foreach ($oldStocks as $oldStock) {
                $attributeValue = AttributeValue::find($oldStock['id']);
                $attributeValue->update([
                    'value' => $oldStock['value'],
                    'quantity' => $oldStock['quantity'] ?? null,
                ]);
            }
        }

        // Thêm giá trị thuộc tính mới
        if ($newStocks) {
            foreach ($newStocks as $newStock) {
                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'value' => $newStock['attribute_value'],
                    'quantity' => $newStock['attribute_quantity'] ?? null,
                ]);
            }
        }

        return redirect()->back()->with(['success' => 'Cập nhật thuộc tính thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->back()->with(['success' => 'Xóa thuộc tính thành công']);
    }

    /**
     * Display a listing of the resource.
     */
    public function trashAttribute()
    {
        $attributes = Attribute::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(5);
        return view('admins.attribute.trash', compact('attributes'));
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restoreAttribute($id)
    {
        $attribute = Attribute::withTrashed()->find($id);

        if ($attribute) {
            $attribute->restore();
            return redirect()->back()->with('success', 'Khôi phục thuộc tính thành công');
        }

        return redirect()->back()->with('error', 'Khôi phục thuộc tính thất bại');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteAttribute($id)
    {
        $attribute = Attribute::withTrashed()->find($id);

        if ($attribute) {
            $attribute->forceDelete();
            return redirect()->back()->with('success', 'Xóa thuộc tính thành công');
        }

        return redirect()->back()->with('error', 'Xóa thuộc tính thất bại');
    }
}
