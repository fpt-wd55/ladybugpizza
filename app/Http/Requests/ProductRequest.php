<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'quantity' => 'nullable|numeric',
            'sku' => 'required|string|max:',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.string' => 'Tên sản phẩm phải là chuỗi',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự',
            'image.required' => 'Vui lòng chọn ảnh sản phẩm',
            'image.image' => 'Ảnh sản phẩm phải là ảnh',
            'image.mimes' => 'Ảnh sản phẩm phải có định dạng jpeg, png, jpg, gif, svg, webp',
            'image.max' => 'Ảnh sản phẩm không được vượt quá 2048 KB',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm',
            'description.string' => 'Mô tả sản phẩm phải là chuỗi',
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm',
            'category_id.exists' => 'Danh mục sản phẩm không tồn tại',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'discount_price.numeric' => 'Giá giảm phải là số',
            'quantity.numeric' => 'Số lượng phải là số',
            'sku.required' => 'Vui lòng nhập SKU',
            'sku.string' => 'SKU phải là chuỗi',
            'sku.max' => 'SKU không được vượt quá 25 ký tự',
            'status.required' => 'Vui lòng chọn trạng thái sản phẩm',
        ];
    }
}
