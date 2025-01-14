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
            'points' => 'required|numeric|min:0',
            'name' => 'required',
            'discount_type' => 'required|numeric|in:1,2',
            'discount_value' => [
                'required',
                'min:0',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($this->input('discount_type') === '1' && $value > 100) {
                        $fail('Giá trị giảm giá không được lớn hơn 100% khi loại giảm giá là phần trăm');
                    }
                }
            ],
            'start_date' => ['required', 'before_or_equal:end_date'],
            'end_date' => ['required', 'after_or_equal:start_date'],
            'quantity' => 'required|integer|min:1|max:9999',
            'min_order_total' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'is_global' => 'required|string',
            'rank_id' => 'nullable|integer',
            'status' => 'nullable',
        ];
    }


    public function rulesForUpdate(): array
    {
        $promotionId = $this->route('promotion') ? $this->route('promotion')->id : null;
        return [
            'name' => 'required',
            'code' => 'required|max:10|unique:promotions,code,' . $promotionId,
            'points' => 'required|numeric|min:0',
            'discount_type' => 'required|numeric|in:1,2',
            'discount_value' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ($this->input('discount_type') === '1' && $value > 100) {
                        $fail('Giá trị giảm giá không được lớn hơn 100%');
                    }
                }
            ],
            'start_date' => ['required', 'before_or_equal:end_date'],
            'end_date' => ['required', 'after_or_equal:start_date'],
            'quantity' => 'required|integer|min:0|max:9999',
            'min_order_total' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'is_global' => 'required|string',
            'rank_id' => 'nullable|integer',
            'status' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Bạn cần nhập tên cho mã giảm giá",
            'code.required' => "Bạn cần nhập mã giảm giá",
            'code.max' => "Tên mã giảm giá không thể quá 10 kí tự",
            'code.unique' => "Tên mã giảm giá đã tồn tại",
            'points.required' => "Bạn cần nhập điểm cho mã giảm giá",
            'points.numeric' => "Điểm phải là một số",
            'discount_type.required' => "Bạn cần chọn loại giảm giá",
            'discount_value.min' => "Giá trị giảm giá không thể là số âm",
            'discount_value.required' => "Bạn cần nhập giá trị giảm giá",
            'discount_value.integer' => "Giá trị giảm giá không hợp lệ",
            'start_date.required' => 'Bạn cần nhập ngày bắt đầu cho mã giảm giá',
            'start_date.date' => 'Ngày bắt đầu phải là một ngày hợp lệ',
            'start_date.before_or_equal' => 'Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc',
            'end_date.required' => 'Bạn cần nhập ngày kết thúc cho mã giảm giá',
            'end_date.date' => 'Ngày kết thúc phải là một ngày hợp lệ',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu',
            'quantity.required' => 'Bạn cần nhập số lượng cho mã giảm giá',
            'quantity.min' => 'Số lượng tối thiểu phải là 1',
            'quantity.integer' => 'Số lượng phải là một số nguyên',
            'quantity.max' => 'Số lượng tối đa không thể lớn hơn 9999',
            'min_order_total.numeric' => 'Giá trị nhập không thể là chữ',
            'min_order_total.min' => 'Giá trị nhập không thể là số âm',
            'max_discount.numeric' => 'Giá trị nhập không thể là chữ ',
            'max_discount.min' => 'Giá trị nhập không thể là số âm',
            'is_global.required' => 'Bạn cần chọn đối tượng áp dụng cho mã giảm giá',
        ];
    }
}
