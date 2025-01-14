<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComboRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $comboId = $this->route('combo')->id ?? null;

        return [
            'name' => 'required|string|max:255|unique:products,name,' . $comboId . ',id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lte:price',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'quantity' => 'required|integer|min:0|max:9999',
            'sku' => 'required|string|min:10|max:15|unique:products,sku,' . $comboId . ',id',
            'description' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên combo',
            'name.string' => 'Tên combo phải là chuỗi',
            'name.max' => 'Tên combo không được vượt quá 255 ký tự',
            'name.unique' => 'Tên combo đã tồn tại',
            'price.required' => 'Vui lòng nhập giá combo',
            'price.numeric' => 'Giá combo phải là số',
            'price.min' => 'Giá combo không được nhỏ hơn 0',
            'discount_price.numeric' => 'Giá giảm phải là số',
            'discount_price.min' => 'Giá giảm không được nhỏ hơn 0',
            'discount_price.lt' => 'Giá giảm phải nhỏ hơn giá gốc',
            'discount_price.lte' => 'Giá giảm phải nhỏ hơn hoặc bằng giá gốc',
            'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif, svg, webp',
            'image.max' => 'Ảnh không được vượt quá 2048 KB',
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.integer' => 'Số lượng phải là số nguyên',
            'quantity.min' => 'Số lượng không được nhỏ hơn 0',
            'quantity.max' => 'Số lượng không được vượt quá 9999',
            'sku.required' => 'Vui lòng nhập mã sản phẩm',
            'sku.string' => 'Mã sản phẩm phải là chuỗi',
            'sku.min' => 'Mã sản phẩm không được nhỏ hơn 10 ký tự',
            'sku.max' => 'Mã sản phẩm không được vượt quá 15 ký tự',
            'sku.unique' => 'Mã sản phẩm đã tồn tại',
            'description.required' => 'Vui lòng nhập mô tả',
            'description.string' => 'Mô tả phải là chuỗi',
        ];
    }
}
