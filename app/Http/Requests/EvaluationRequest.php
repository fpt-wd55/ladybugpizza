<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
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
            'ratings' => 'required|array',
            'ratings.*' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|array',
            'comments.*' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'ratings.required' => 'Vui lòng chọn đánh giá cho sản phẩm',
            'ratings.*.required' => 'Vui lòng chọn đánh giá cho sản phẩm',
            'ratings.*.integer' => 'Đánh giá phải là số nguyên',
            'ratings.*.min' => 'Đánh giá phải lớn hơn hoặc bằng 1',
            'ratings.*.max' => 'Đánh giá phải nhỏ hơn hoặc bằng 5',
            'comments.*.string' => 'Bình luận không hợp lệ',
            'comments.*.max' => 'Bình luận không được vượt quá 500 ký tự',
        ];
    }
}
