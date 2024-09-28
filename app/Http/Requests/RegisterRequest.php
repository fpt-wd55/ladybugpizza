<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:7|max:11|unique:users,phone',
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/|confirmed',
            'password_confirmation' => 'required',
            'agree' => 'accepted'
        ];
    }
    public function messages(): array {
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.min' => 'Số điện thoại phải có ít nhất 7 ký tự',
            'phone.max' => 'Số điện thoại không được quá 11 ký tự',
            'phone.unique' => 'Số điện thoại đã tồn tại trong hệ thống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 1 ký tự viết hoa, 1 ký tự số và 1 ký tự đặc biệt',
            'password.confirmed' => 'Nhập lại mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Nhập lại mật khẩu không được để trống',
            'agree.accepted' => 'Bạn cần đồng ý với các chính sách và điều khoản',
        ];
    }
}
