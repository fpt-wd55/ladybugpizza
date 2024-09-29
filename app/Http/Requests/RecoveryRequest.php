<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecoveryRequest extends FormRequest
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
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/',
            'password_confirmation' => 'required'
        ];
    }

    public function messages(): array {
        return [
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 1 ký tự viết hoa, 1 ký tự số và 1 ký tự đặc biệt',
            'password.confirmed' => 'Nhập lại mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Nhập lại mật khẩu không được để trống'
        ];
    }
}
