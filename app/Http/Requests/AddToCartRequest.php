<?php

namespace App\Http\Requests;

use App\Models\Attribute as ModelsAttribute;
use Attribute;
use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
    public function rules()
    {
        $product = $this->route('product');
        $attributes = ModelsAttribute::with('values')
            ->where('category_id', $product->category->id)
            ->where('status', 1)
            ->get();

        $rules = [
            'quantity' => 'required|integer|min:1',
            'toppings' => 'nullable|array',
            'toppings.*' => 'exists:toppings,id',
        ];

        foreach ($attributes as $attribute) {
            $rules['attributes_' . $attribute->slug] = 'required';
        }

        return $rules;
    }

    /**
     * Summary of messages
     * @return array
     */
    public function messages()
    {
        $product = $this->route('product');
        $attributes = ModelsAttribute::with('values')
            ->where('category_id', $product->category->id)
            ->where('status', 1)
            ->get();

        $messages = [
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.integer' => 'Số lượng không hợp lệ',
            'quantity.min' => 'Số lượng không hợp lệ',
            'toppings.array' => 'Toppings phải là một mảng',
            'toppings.*.exists' => 'Topping không hợp lệ',
        ];

        foreach ($attributes as $attribute) {
            $messages['attributes_' . $attribute->slug . '.required'] = 'Vui lòng chọn phân loại hàng';
        }

        return $messages;
    }
}
