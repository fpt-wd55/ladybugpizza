<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOpeningHoursRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Đặt thành true nếu không có logic phân quyền
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'opening_hours' => 'required|array',
            'opening_hours.*.open_time' => 'nullable|date_format:H:i',
            'opening_hours.*.close_time' => 'nullable|date_format:H:i|after:opening_hours.*.open_time',
            'opening_hours.*.is_open' => 'nullable|boolean',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'opening_hours.required' => 'Dữ liệu giờ mở cửa là bắt buộc.',
            'opening_hours.*.open_time.date_format' => 'Giờ mở cửa không đúng định dạng.',
            'opening_hours.*.close_time.date_format' => 'Giờ đóng cửa không đúng định dạng.',
            'opening_hours.*.close_time.after' => 'Giờ đóng cửa phải sau giờ mở cửa.',
            'opening_hours.*.is_open.boolean' => 'Trạng thái mở cửa phải là giá trị hợp lệ.',
        ];
    }
}
