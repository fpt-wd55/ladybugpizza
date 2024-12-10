<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        $profileId = Auth::id();
        return [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $profileId,
            'phone' => 'required|string|digits:10|regex:/^\d+$/|unique:users,phone,' . $profileId,
            'gender' => 'nullable|string',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Họ và tên không được để trống',
            'fullname.string' => 'Họ và tên phải là chuỗi ký tự',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.digits' => 'Số điện thoại không hợp lệ',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'avatar.image' => 'File được chọn không phải là ảnh',
            'avatar.mimes' => 'Ảnh đại diện không đúng định dạng',
            'avatar.max' => 'Dung lượng ảnh đại diện không được vượt quá 2MB',
            'date_of_birth.before_or_equal' => 'Ngày sinh không hợp lệ',
            'date_of_birth.required' => 'Ngày sinh không được để trống',
        ];
    }
}
