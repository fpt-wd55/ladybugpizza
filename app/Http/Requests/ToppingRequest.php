<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToppingRequest extends FormRequest
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

    public function rulesForCreate(): array
    {
        return [
            'name' => 'required',
            'quantity' => 'required|min:0|numeric',
            'image' => 'required|mimes:jpeg,png,jpg,gif,bmp,svg,webp',
            'price' => 'required|numeric|min:0|',
            'category_id' => 'required',
        ];
    }

    public function rulesForUpdate(): array
    {
        return [
            'name' => 'required',
            'quantity' => 'required|min:0|numeric',
            'image' => 'mimes:jpeg,png,jpg,gif,bmp,svg,webp',
            'price' => 'required|numeric|min:0|',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',   
            'quantity.required' => 'Số lượng không được bỏ trống',   
            'quantity.min' => 'Số lượng phải lớn hơn 0',   
            'quantity.numeric' => 'Giá phải là một số',
            'image.mimes' => 'Ảnh không đúng định dạng',
            'price.required' => 'Giá không được bỏ trống',
            'price.numeric' => 'Giá phải là một số',
            'price.min' => 'Giá không thể dưới 0 đồng',
            'category_id' => 'Danh mục không được bỏ trống',
            'image.required' => 'Ảnh không được bỏ trống',
        ];
    }
}
