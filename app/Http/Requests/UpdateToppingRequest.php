<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateToppingRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,bmp,svg,webp',
            'price' => 'required|numeric|min:1000|',
            'category_id' => 'required',
        ];
    }
    public function messages () {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'image.mimes' => 'Ảnh không đúng định dạng',
            'price.required' => 'Giá không được để trống',
            'price.numeric' => 'Giá phải là một số',
            'price.min' => 'Giá không thể dưới 1000',
            'category_id' => 'Danh mục không được bỏ trống',
        ];
    }
}
