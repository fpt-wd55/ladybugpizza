<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
            'code' => 'required',
            'discription' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required',
            'start_date' => ['required', 'date', 'before_or_equal:end_date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'quantity' => 'required',
            'min_order_total' => 'required|min>max_discount',
            'max_discount' => 'required',
        ];
    }

    public function rulesForUpdate(): array
    {
        return [
            'code' => 'required',
            'discription' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required',
            'start_date' => ['required', 'date', 'before_or_equal:end_date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'image.mimes' => 'Ảnh không đúng định dạng',
            'price.required' => 'Giá không được bỏ trống',
            'price.numeric' => 'Giá phải là một số',
            'price.min' => 'Giá không thể dưới 0 đồng',
            'category_id' => 'Danh mục không được bỏ trống',
            'image.required' => 'Ảnh không được bỏ trống',
        ];
    }
}
