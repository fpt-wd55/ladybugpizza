<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRequest extends FormRequest
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
            'current_password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/',
            'new_password' => 'same:password'
        ];
    }
    public function messages(): array
    {
        return [
            'current_password.required' => 'Mật khẩu không được để trống',
            'current_password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.regex' => 'Mật khẩu phải chứa ít nhất 1 ký tự viết hoa, 1 ký tự số và 1 ký tự đặc biệt',
            'new_password.same' => 'Nhập lại mật khẩu không trùng khớp'
        ];
    }
}