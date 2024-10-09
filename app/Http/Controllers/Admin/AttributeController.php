<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
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
        //
        return view('admins.attribute.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = ["attribute_name" => "required", "stocks.*" => "required"];

        foreach ($request->stocks as $key => $value) {
            $rules["stocks.{$key}.attribute_value"] = 'required';
            $rules["stocks.{$key}.attribute_quantity"] = 'nullable|numeric';
        }

        $messages = [
            'attribute_name.required' => 'Vui lòng nhập tên thuộc tính',
            'stocks.*.required' => 'Vui lòng nhập giá trị thuộc tính cho sản phẩm',
            'stocks.*.attribute_value.required' => 'Vui lòng nhập giá trị thuộc tính cho sản phẩm',
            'stocks.*.attribute_quantity.numeric' => 'Giá trị không hợp lệ',
        ];

        $request->validate($rules, $messages);

        $attribute = Attribute::create(
            [
                "name" => $request->attribute_name,
                "status" => 1
            ]
        );

        if (!$attribute) {
            // Vietnamese error message
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
        return view('admins.attribute.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        $rules = ["attribute_name" => "required", "stocks.*" => "required"];

        foreach ($request->stocks as $key => $value) {
            $rules["stocks.{$key}.attribute_value"] = 'required';
            $rules["stocks.{$key}.attribute_quantity"] = 'nullable|numeric';
        }

        $messages = [
            'attribute_name.required' => 'Vui lòng nhập tên thuộc tính',
            'stocks.*.required' => 'Vui lòng nhập giá trị thuộc tính cho sản phẩm',
            'stocks.*.attribute_value.required' => 'Vui lòng nhập giá trị thuộc tính cho sản phẩm',
            'stocks.*.attribute_quantity.numeric' => 'Giá trị không hợp lệ',
        ];

        $request->validate($rules, $messages);

        $attribute->update([
            'name' => $request->attribute_name,
            'status' => 1
        ]);

        if (!$attribute) {
            return redirect()->back()->with(['error' => 'Câp nhật thuộc tính không thành công.']);
        }
        foreach ($request->stocks as $key => $value) {
            AttributeValue::create([
                'attribute_id' => $attribute->id,
                'value' => $value['attribute_value'],
                'quantity' => $value['attribute_quantity'] ?? null,
            ]);
        }
        return redirect()->route('admin.attributes.edit', $attribute)->with(['success' => 'Thêm thuộc tính thành công']);
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
        $attributes = Attribute::onlyTrashed()->paginate(5);
        return view('admins.attribute.trash', compact('attributes'));
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restoreAttribute(Attribute $attribute)
    {
        dd($attribute);
        $attribute->restore();
        return redirect()->back()->with(['success' => 'Khôi phục thuộc tính thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteAttribute(Attribute $attribute)
    {
        $attribute->forceDelete();
        return redirect()->back()->with(['success' => 'Xóa thuộc tính vĩnh viễn thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function removeValue(AttributeValue $value)
    {
        $value->delete();
        return redirect()->back()->with(['success' => 'Xóa giá trị thuộc tính thành công']);
    }
}
