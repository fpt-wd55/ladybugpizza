<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::paginate(10);
        foreach ($attributes as $attribute) {
            $attribute->values = $attribute->values;
        }
        // dd($attributes);
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

        dd($request->all());

        // $product = Product::create(["name" => $request->name]);
        // foreach ($request->stocks as $key => $value) {
        //     $product->stocks()->create($value);
        // }

        // return redirect()->back()->with(['success' => 'Product created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        //
    }
}
