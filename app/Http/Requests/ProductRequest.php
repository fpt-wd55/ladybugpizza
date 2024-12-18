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
        if ($this->isMethod('post')) {
            return $this->rulesForCreate();
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return $this->rulesForUpdate();
        }

        return [];
    }

    private function rulesForCreate()
    {
        return [
            'name' => 'required|string|max:255|unique:products,name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lte:price',
            'quantity' => 'required_if:category_id,!=,null|integer|min:0',
            'sku' => 'required|string|min:10|max:15|unique:products,sku',

        ];
    }

    private function rulesForUpdate()
    {
        $productId = $this->route('product') ? $this->route('product')->id : null;
        return [
            'name' => 'required|string|max:255|unique:products,name,' . $productId,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lte:price',
            'quantity' => 'required_if:category_id,!=,null|integer|min:0',
            'sku' => 'required|string|min:10|max:15|unique:products,sku,' . $productId,
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.string' => 'Tên sản phẩm phải là chuỗi',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'image.required' => 'Vui lòng chọn ảnh sản phẩm',
            'image.image' => 'Ảnh sản phẩm phải là ảnh',
            'image.mimes' => 'Ảnh sản phẩm phải có định dạng jpeg, png, jpg, gif, svg, webp',
            'image.max' => 'Ảnh sản phẩm không được vượt quá 2048 KB',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm',
            'description.string' => 'Mô tả sản phẩm phải là chuỗi',
            'category_id.required' => 'Vui lòng chọn danh mục sản phẩm',
            'category_id.exists' => 'Danh mục sản phẩm không tồn tại',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm không hợp lệ',
            'price.min' => 'Giá sản phẩm không được nhỏ hơn 0',
            'discount_price.numeric' => 'Giá khuyến mãi không hợp lệ',
            'discount_price.min' => 'Giá khuyến mãi không được nhỏ hơn 0',
            'discount_price.lte' => 'Giá khuyến mãi phải nhỏ hơn hoặc bằng giá sản phẩm',
            'quantity.required_if' => 'Vui lòng nhập số lượng sản phẩm',
            'quantity.integer' => 'Vui lòng nhập số lượng sản phẩm',
            'quantity.min' => 'Số lượng sản phẩm phải lớn hơn hoặc bằng 0',
            'sku.required' => 'Vui lòng nhập SKU',
            'sku.string' => 'SKU phải là chuỗi',
            'sku.min' => 'SKU tối thiểu 10 ký tự',
            'sku.max' => 'SKU tối đa 15 ký tự',
            'sku.unique' => 'SKU đã tồn tại',
        ];
    }
}
