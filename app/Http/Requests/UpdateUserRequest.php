<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'fullname' => 'required|string|max:255',
			'email' => 'required|email|max:255',
			'phone' => 'nullable|string|max:20',
			'gender' => 'nullable|string',
			'date_of_birth' => 'nullable|date',
			'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }

    public function messages():array {
        return[
            'fullname.required' => 'Họ và tên không được để trống',
            'fullname.string' => 'Họ và tên phải là chuỗi ký tự',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.digits_between' => 'Số điện thoại không hợp lệ',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'avatar.image' => 'File được chọn không phải là ảnh',
            'avatar.mimes' => 'Ảnh đại diện không đúng định dạng',
            'avatar.max' => 'Dung lượng ảnh đại diện không được vượt quá 2MB',
        ];
    }
}
