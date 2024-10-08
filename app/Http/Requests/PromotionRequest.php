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
            'description' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required',
            'start_date' => ['required', 'before_or_equal:end_date'],
            'end_date' => ['required', 'after_or_equal:start_date'],
            'quantity' => 'required',
            'min_order_total' => 'nullable|numeric',
            'max_discount' => 'nullable|numeric ',
            'status' => 'required', 
            'is_global' => 'required', 
        ];
    }

    public function rulesForUpdate(): array
    {
        return [
            'code' => 'required',
            'description' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required',
            'start_date' => ['required', 'date', 'before_or_equal:end_date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'quantity' => 'required',
            'min_order_total' => 'nullable|numeric',
            'max_discount' => 'nullable|numeric ',
            'status' => 'required',  
            'is_global' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'code.required' => "Tên mã giảm giá không được bỏ trống",
            'description.required' => "Bạn cần mô tả cho mã giảm giá này",
            'discount_type.required' => "Loại mã giảm giá không được bỏ trống",
            'discount_value.required' => "Bạn cần chọn giá trị giảm giá",
            'discount_value.regex' => "Giá trị giảm giá không hợp lệ, phải là số hoặc phần trăm",
            'start_date.required' => 'Ngày bắt đầu là bắt buộc',
            'start_date.date' => 'Ngày bắt đầu phải là một ngày hợp lệ',
            'start_date.before_or_equal' => 'Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc',
            'end_date.required' => 'Ngày kết thúc là bắt buộc',
            'end_date.date' => 'Ngày kết thúc phải là một ngày hợp lệ',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu',
            'quantity.required' => 'Số lượng không được bỏ trống',
            'min_order_total.numeric' => 'Giá trị nhập phải là số',
            'max_discount.numeric' => 'Giá trị nhập phải là số ',
            'status.required' => 'Vui lòng chọn trạng thái',
            'is_global.required' => 'Vui lòng chọn đối tượng áp dụng',
        ];
    }
}
